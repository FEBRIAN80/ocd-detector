<?php
include 'config/database.php';
checkLogin();
$db = new Database();

// Ambil hasil test terakhir user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM hasil_test WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 1";
$result = $db->conn->query($query);
$hasil = $result->fetch_assoc();

if (!$hasil) {
    header("Location: kuesioner.php");
    exit();
}

// Data untuk chart
$skor = $hasil['total_skor'];
$max_skor = 40;
$persentase = ($skor / $max_skor) * 100;

// Penjelasan kategori
$penjelasan = [
    'Sangat Ringan' => 'Gejala OCD yang Anda alami berada pada tingkat sangat ringan. Kondisi ini umumnya tidak mengganggu aktivitas sehari-hari.',
    'Ringan' => 'Anda mengalami gejala OCD ringan. Beberapa gejala mungkin muncul namun masih dapat dikelola dengan baik.',
    'Sedang' => 'Gejala OCD yang dialami sudah pada tingkat sedang dan mungkin mulai mengganggu beberapa aspek kehidupan.',
    'Cukup Berat' => 'Gejala OCD cukup berat dan kemungkinan sudah mempengaruhi kualitas hidup Anda. Disarankan untuk berkonsultasi dengan profesional.',
    'Sangat Berat' => 'Gejala OCD yang dialami berada pada tingkat berat dan sangat disarankan untuk segera berkonsultasi dengan tenaga profesional kesehatan mental.'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes - OCD Detector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">OCD Detector</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Halo, <?php echo $_SESSION['user_nama']; ?></span>
                    <a href="logout.php" class="text-red-600 hover:text-red-700">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Header Surat -->
            <div class="border-b-2 border-gray-300 pb-6 mb-6">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-indigo-600 mb-1">OCD DETECTOR</h1>
                    <p class="text-sm text-gray-600">Sistem Deteksi Dini Obsessive Compulsive Disorder</p>
                    <p class="text-xs text-gray-500 mt-1">Laporan Hasil Tes Psikologis</p>
                </div>
            </div>

            <!-- Info Pasien -->
            <div class="grid grid-cols-2 gap-6 mb-8 text-sm">
                <div>
                    <p class="text-gray-600"><span class="font-semibold">Nama Pasien:</span> <?php echo $_SESSION['user_nama']; ?></p>
                    <p class="text-gray-600 mt-1"><span class="font-semibold">Email:</span> <?php echo $_SESSION['user_email']; ?></p>
                </div>
                <div class="text-right">
                    <p class="text-gray-600"><span class="font-semibold">Tanggal Tes:</span> <?php echo date('d-m-Y', strtotime($hasil['created_at'])); ?></p>
                    <p class="text-gray-600 mt-1"><span class="font-semibold">Jam Tes:</span> <?php echo date('H:i', strtotime($hasil['created_at'])); ?></p>
                </div>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Hasil Tes OCD Anda</h1>
                <p class="text-gray-600">Berikut adalah hasil assessment yang telah Anda lakukan</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <!-- Chart -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <canvas id="hasilChart" width="400" height="400"></canvas>
                </div>

                <!-- Info Hasil -->
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="text-6xl font-bold text-indigo-600 mb-2"><?php echo $skor; ?></div>
                        <div class="text-2xl font-semibold text-gray-900">Total Skor</div>
                        <div class="text-lg text-gray-600">dari 40 poin maksimal</div>
                    </div>

                    <div class="text-center">
                        <div class="inline-block px-4 py-2 rounded-full 
                            <?php
                            $color_classes = [
                                'Sangat Ringan' => 'bg-green-100 text-green-800',
                                'Ringan' => 'bg-blue-100 text-blue-800',
                                'Sedang' => 'bg-yellow-100 text-yellow-800',
                                'Cukup Berat' => 'bg-orange-100 text-orange-800',
                                'Sangat Berat' => 'bg-red-100 text-red-800'
                            ];
                            echo $color_classes[$hasil['kategori']];
                            ?>
                            text-lg font-semibold">
                            <?php echo $hasil['kategori']; ?>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Penjelasan:</h3>
                        <p class="text-gray-700"><?php echo $penjelasan[$hasil['kategori']]; ?></p>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-semibold text-blue-900 mb-3">📝 Catatan Penting:</h3>
                <ul class="text-blue-800 space-y-2">
                    <li>• Hasil ini merupakan skrining awal dan bukan diagnosis medis</li>
                    <li>• Jika hasil menunjukkan gejala sedang hingga berat, disarankan berkonsultasi dengan profesional</li>
                    <li>• Tes ini dapat diulang untuk memantau perkembangan</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center no-print mt-8">
                <a href="download_invoice.php" 
                   class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8m0 8l-9-2m9 2l9-2m-9-8l9-2m-9 2l-9-2"></path>
                    </svg>
                    Download Invoice
                </a>
                <a href="kuesioner.php" 
                   class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 text-center">
                    Tes Ulang
                </a>
                <a href="index.php" 
                   class="border-2 border-indigo-600 text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition duration-300 text-center">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('hasilChart').getContext('2d');
            const skor = <?php echo $skor; ?>;
            const maxSkor = 40;
            const sisaSkor = maxSkor - skor;
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Skor Anda', 'Sisa Skor'],
                    datasets: [{
                        data: [skor, sisaSkor],
                        backgroundColor: [
                            getColorBySkor(skor),
                            '#e5e7eb'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw + ' poin';
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });

            function getColorBySkor(skor) {
                if (skor <= 7) return '#10b981';
                if (skor <= 15) return '#3b82f6';
                if (skor <= 23) return '#f59e0b';
                if (skor <= 31) return '#f97316';
                return '#ef4444';
            }
        });
    </script>
</body>
</html>