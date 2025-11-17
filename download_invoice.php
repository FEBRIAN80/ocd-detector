<?php
ob_start();
include 'config/database.php';
checkLogin();
$db = new Database();

// Ambil hasil test terakhir user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM hasil_test WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 1";
$result = $db->conn->query($query);
$hasil = $result->fetch_assoc();

if (!$hasil) {
    die("Tidak ada data test");
}

// Ambil jawaban user untuk test terakhir
$jawaban_query = "SELECT DISTINCT j.jawaban, p.pertanyaan_text, p.urutan, p.id
                  FROM jawaban_user j 
                  INNER JOIN pertanyaan p ON j.pertanyaan_id = p.id 
                  INNER JOIN hasil_test h ON j.user_id = h.user_id
                  WHERE j.user_id = '$user_id' AND h.id = " . $hasil['id'] . "
                  ORDER BY p.urutan";
$jawaban_result = $db->conn->query($jawaban_query);
$jawaban_list = $jawaban_result->fetch_all(MYSQLI_ASSOC);

// Mapping nilai jawaban
$nilai_text = [
    0 => 'Tidak Pernah',
    1 => 'Jarang',
    2 => 'Kadang-kadang',
    3 => 'Sering',
    4 => 'Sangat Sering'
];

// Penjelasan kategori
$penjelasan = [
    'Sangat Ringan' => 'Gejala OCD yang Anda alami berada pada tingkat sangat ringan. Kondisi ini umumnya tidak mengganggu aktivitas sehari-hari.',
    'Ringan' => 'Anda mengalami gejala OCD ringan. Beberapa gejala mungkin muncul namun masih dapat dikelola dengan baik.',
    'Sedang' => 'Gejala OCD yang dialami sudah pada tingkat sedang dan mungkin mulai mengganggu beberapa aspek kehidupan.',
    'Cukup Berat' => 'Gejala OCD cukup berat dan kemungkinan sudah mempengaruhi kualitas hidup Anda. Disarankan untuk berkonsultasi dengan profesional.',
    'Sangat Berat' => 'Gejala OCD yang dialami berada pada tingkat berat dan sangat disarankan untuk segera berkonsultasi dengan tenaga profesional kesehatan mental.'
];

$skor = $hasil['total_skor'];
$max_skor = 40;
$kategori_class = str_replace(' ', '-', strtolower($hasil['kategori']));

// Generate table rows
$table_rows = '';
foreach ($jawaban_list as $index => $j) {
    $table_rows .= '<tr>
        <td style="text-align: center; padding: 8px; border: 1px solid #d1d5db;">' . ($index + 1) . '</td>
        <td style="padding: 8px; border: 1px solid #d1d5db;">' . substr($j['pertanyaan_text'], 0, 60) . '...</td>
        <td style="padding: 8px; border: 1px solid #d1d5db;">' . $nilai_text[$j['jawaban']] . '</td>
        <td style="text-align: center; font-weight: bold; padding: 8px; border: 1px solid #d1d5db;">' . $j['jawaban'] . '</td>
    </tr>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Hasil Tes OCD</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            width: 210mm;
            padding: 30px;
            margin: 0 auto;
            background: white;
        }
        .header {
            text-align: center;
            border-bottom: 4px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4f46e5;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            color: #666;
            margin: 2px 0;
        }
        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            font-size: 12px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: bold;
            color: #333;
        }
        .info-value {
            color: #666;
            margin-top: 2px;
        }
        .score-box {
            background: #e0e7ff;
            border: 2px solid #a5b4fc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .score-box p:first-child {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }
        .score {
            font-size: 48px;
            font-weight: bold;
            color: #4f46e5;
            margin: 10px 0;
        }
        .max {
            font-size: 12px;
            color: #666;
        }
        .category-box {
            margin-bottom: 20px;
        }
        .category-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            font-size: 12px;
        }
        .category-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
        }
        .category-sangat-ringan { background: #dcfce7; color: #166534; }
        .category-ringan { background: #dbeafe; color: #1e40af; }
        .category-sedang { background: #fef3c7; color: #92400e; }
        .category-cukup-berat { background: #fed7aa; color: #92400e; }
        .category-sangat-berat { background: #fee2e2; color: #991b1b; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }
        table th {
            background: #f3f4f6;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #d1d5db;
        }
        table tr:nth-child(even) {
            background: #f9fafb;
        }
        .explanation {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 11px;
        }
        .explanation-title {
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .explanation-text {
            color: #1e3a8a;
            line-height: 1.4;
        }
        .notes {
            background: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 10px;
        }
        .notes-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 5px;
        }
        .notes-list {
            color: #b45309;
            line-height: 1.4;
        }
        .signature-section {
            border-top: 2px solid #d1d5db;
            margin-top: 30px;
            padding-top: 20px;
        }
        .signature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            font-size: 11px;
        }
        .signature-item {
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin: 30px 0 3px 0;
            height: 1px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #d1d5db;
            font-size: 9px;
            color: #999;
        }
        @media print {
            body { padding: 0; margin: 0; }
            .container { width: auto; padding: 0; margin: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>OCD DETECTOR</h1>
            <p>Sistem Deteksi Dini Obsessive Compulsive Disorder</p>
            <p>Laporan Hasil Tes Psikologis</p>
        </div>

        <!-- Info Pasien -->
        <div class="info-section">
            <div>
                <div class="info-item">
                    <span class="info-label">Nama Pasien:</span>
                    <div class="info-value"><?php echo $_SESSION['user_nama']; ?></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <div class="info-value"><?php echo $_SESSION['user_email']; ?></div>
                </div>
            </div>
            <div style="text-align: right;">
                <div class="info-item">
                    <span class="info-label">Tanggal Tes:</span>
                    <div class="info-value"><?php echo date('d-m-Y', strtotime($hasil['created_at'])); ?></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Jam Tes:</span>
                    <div class="info-value"><?php echo date('H:i', strtotime($hasil['created_at'])); ?></div>
                </div>
            </div>
        </div>

        <!-- Skor -->
        <div class="score-box">
            <p>TOTAL SKOR</p>
            <div class="score"><?php echo $skor; ?></div>
            <div class="max">dari <?php echo $max_skor; ?> poin maksimal</div>
        </div>

        <!-- Kategori -->
        <div class="category-box">
            <div class="category-label">KATEGORI HASIL:</div>
            <div class="category-badge category-<?php echo $kategori_class; ?>">
                <?php echo $hasil['kategori']; ?>
            </div>
        </div>

        <!-- Tabel Jawaban -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table_rows; ?>
            </tbody>
        </table>

        <!-- Penjelasan -->
        <div class="explanation">
            <div class="explanation-title">📋 PENJELASAN HASIL:</div>
            <div class="explanation-text"><?php echo $penjelasan[$hasil['kategori']]; ?></div>
        </div>

        <!-- Catatan Penting -->
        <div class="notes">
            <div class="notes-title">⚠️ CATATAN PENTING:</div>
            <div class="notes-list">
                • Hasil ini merupakan skrining awal dan BUKAN diagnosis medis<br>
                • Untuk hasil yang lebih akurat, konsultasikan dengan profesional kesehatan mental<br>
                • Jika hasil menunjukkan gejala sedang hingga berat, segera berkonsultasi dengan ahli
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-section">
            <div class="signature-grid">
                <div class="signature-item">
                    <div>Pasien/Pihak Bertanggung Jawab</div>
                    <div class="signature-line"></div>
                    <div><?php echo $_SESSION['user_nama']; ?></div>
                </div>
                <div class="signature-item">
                    <div>Sistem OCD Detector</div>
                    <div class="signature-line"></div>
                    <div>Tanggal: <?php echo date('d-m-Y'); ?></div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            OCD Detector © 2024 - Sistem Deteksi Dini Obsessive Compulsive Disorder<br>
            Laporan ini dibuat oleh sistem dan berlaku sebagai dokumen sah
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
<?php
ob_end_flush();
?>
