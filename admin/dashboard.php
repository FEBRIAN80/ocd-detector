<?php
include '../config/database.php';
checkAdminLogin();
$db = new Database();

// Ambil data users dan hasil test
$query = "SELECT u.nama, u.email, h.total_skor, h.kategori, h.created_at 
          FROM users u 
          INNER JOIN hasil_test h ON u.id = h.user_id 
          ORDER BY h.total_skor DESC";
$result = $db->conn->query($query);
$users_data = $result->fetch_all(MYSQLI_ASSOC);

// Hitung statistik
$total_users = count($users_data);
$skor_tertinggi = $total_users > 0 ? $users_data[0]['total_skor'] : 0;
$skor_terendah = $total_users > 0 ? $users_data[count($users_data)-1]['total_skor'] : 0;

// Hitung distribusi kategori
$kategori_count = [
    'Sangat Ringan' => 0,
    'Ringan' => 0,
    'Sedang' => 0,
    'Cukup Berat' => 0,
    'Sangat Berat' => 0
];

foreach ($users_data as $user) {
    $kategori_count[$user['kategori']]++;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - OCD Detector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">OCD Detector - Admin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Halo, <?php echo $_SESSION['admin_username']; ?></span>
                    <a href="logout.php" class="text-red-600 hover:text-red-700">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-3xl font-bold text-indigo-600"><?php echo $total_users; ?></div>
                <div class="text-gray-600">Total User</div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-3xl font-bold text-green-600"><?php echo $skor_terendah; ?></div>
                <div class="text-gray-600">Skor Terendah</div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-3xl font-bold text-red-600"><?php echo $skor_tertinggi; ?></div>
                <div class="text-gray-600">Skor Tertinggi</div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-3xl font-bold text-blue-600">
                    <?php echo $total_users > 0 ? round(array_sum(array_column($users_data, 'total_skor')) / $total_users, 1) : 0; ?>
                </div>
                <div class="text-gray-600">Rata-rata Skor</div>
            </div>
        </div>

        <!-- Grafik Distribusi -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Distribusi Kategori OCD</h2>
            <div class="h-64">
                <canvas id="distribusiChart"></canvas>
            </div>
        </div>

        <!-- Tabel Data User -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Data Hasil Tes User</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Skor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (count($users_data) > 0): ?>
                            <?php foreach ($users_data as $user): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($user['nama']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold 
                                    <?php
                                    $skor_color = [
                                        'Sangat Ringan' => 'text-green-600',
                                        'Ringan' => 'text-blue-600',
                                        'Sedang' => 'text-yellow-600',
                                        'Cukup Berat' => 'text-orange-600',
                                        'Sangat Berat' => 'text-red-600'
                                    ];
                                    echo $skor_color[$user['kategori']];
                                    ?>
                                "><?php echo $user['total_skor']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        <?php
                                        $badge_color = [
                                            'Sangat Ringan' => 'bg-green-100 text-green-800',
                                            'Ringan' => 'bg-blue-100 text-blue-800',
                                            'Sedang' => 'bg-yellow-100 text-yellow-800',
                                            'Cukup Berat' => 'bg-orange-100 text-orange-800',
                                            'Sangat Berat' => 'bg-red-100 text-red-800'
                                        ];
                                        echo $badge_color[$user['kategori']];
                                        ?>
                                    ">
                                        <?php echo $user['kategori']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada data user
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grafik distribusi kategori
            const ctx = document.getElementById('distribusiChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sangat Ringan', 'Ringan', 'Sedang', 'Cukup Berat', 'Sangat Berat'],
                    datasets: [{
                        label: 'Jumlah User',
                        data: [
                            <?php echo $kategori_count['Sangat Ringan']; ?>,
                            <?php echo $kategori_count['Ringan']; ?>,
                            <?php echo $kategori_count['Sedang']; ?>,
                            <?php echo $kategori_count['Cukup Berat']; ?>,
                            <?php echo $kategori_count['Sangat Berat']; ?>
                        ],
                        backgroundColor: [
                            '#10b981',
                            '#3b82f6', 
                            '#f59e0b',
                            '#f97316',
                            '#ef4444'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>