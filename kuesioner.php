<?php
$page_title = 'Kuesioner OCD';
include 'includes/header.php';
$db = new Database();

// Ambil pertanyaan dari database
$query = "SELECT * FROM pertanyaan ORDER BY urutan";
$result = $db->conn->query($query);
$pertanyaan = $result->fetch_all(MYSQLI_ASSOC);
?>

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
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Kuesioner Deteksi Dini OCD</h1>
                <p class="text-gray-600">Jawablah setiap pertanyaan dengan jujur sesuai dengan pengalaman Anda dalam 2 minggu terakhir</p>
            </div>

            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress</span>
                    <span class="text-sm font-medium text-gray-700" id="progress-text">0/<?php echo count($pertanyaan); ?></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div id="progress-bar" class="bg-indigo-600 h-3 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>

            <form id="kuesioner-form" method="POST" action="proses_kuesioner.php">
                <div class="space-y-8">
                    <?php foreach ($pertanyaan as $index => $p): ?>
                    <div class="pertanyaan-group border-b border-gray-200 pb-8">
                        <div class="flex items-start space-x-4">
                            <span class="bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold flex-shrink-0 mt-1">
                                <?php echo $index + 1; ?>
                            </span>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4"><?php echo $p['pertanyaan_text']; ?></h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                                    <?php 
                                    $opsi = [
                                        0 => 'Tidak Pernah',
                                        1 => 'Jarang', 
                                        2 => 'Kadang-kadang',
                                        3 => 'Sering',
                                        4 => 'Sangat Sering'
                                    ];
                                    ?>
                                    <?php foreach ($opsi as $nilai => $label): ?>
                                    <label class="jawaban-option cursor-pointer">
                                        <input type="radio" name="jawaban[<?php echo $p['id']; ?>]" value="<?php echo $nilai; ?>" 
                                               class="hidden peer" required>
                                        <div class="bg-gray-100 border-2 border-gray-300 rounded-lg p-4 text-center transition-all duration-200 peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-700 hover:bg-gray-50">
                                            <div class="font-semibold text-sm mb-1"><?php echo $label; ?></div>
                                            <div class="text-xs text-gray-500">(<?php echo $nilai; ?>)</div>
                                        </div>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-8 text-center">
                    <button type="submit" 
                            class="bg-indigo-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submit-btn">
                        Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kuesioner-form');
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            const submitBtn = document.getElementById('submit-btn');
            const totalQuestions = <?php echo count($pertanyaan); ?>;
            
            // Hitung progress
            function updateProgress() {
                const answered = document.querySelectorAll('input[type="radio"]:checked').length;
                const progress = (answered / totalQuestions) * 100;
                
                progressBar.style.width = progress + '%';
                progressText.textContent = answered + '/' + totalQuestions;
                
                // Enable/disable submit button
                submitBtn.disabled = answered < totalQuestions;
            }
            
            // Event listener untuk semua radio button
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });
            
            // Validasi form sebelum submit
            form.addEventListener('submit', function(e) {
                const answered = document.querySelectorAll('input[type="radio"]:checked').length;
                if (answered < totalQuestions) {
                    e.preventDefault();
                    alert('Harap jawab semua pertanyaan sebelum mengirim!');
                }
            });
            
            // Update progress awal
            updateProgress();
        });
    </script>

<?php include 'includes/footer.php'; ?>
</html>