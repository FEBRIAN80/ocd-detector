<?php 
$page_title = 'Deteksi Dini OCD';
$is_public = true;
include 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deteksi Dini OCD - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">OCD Detector</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="login.php" class="text-gray-600 hover:text-indigo-600 transition duration-300">Login</a>
                    <a href="register.php" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 animate-fade-in">
                    Deteksi Dini 
                    <span class="text-indigo-600">Obsessive Compulsive Disorder</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Lakukan tes skrining online untuk memahami gejala OCD Anda. 
                    Dapatkan insight tentang kondisi mental Anda dengan alat assessment yang terpercaya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="register.php" class="bg-indigo-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-lg">
                        Mulai Tes Sekarang
                    </a>
                    <a href="#tentang" class="border-2 border-indigo-600 text-indigo-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-indigo-50 transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Melakukan Tes Ini?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Pahami pentingnya deteksi dini untuk penanganan yang lebih baik</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-blue-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Deteksi Dini</h3>
                    <p class="text-gray-600">Identifikasi gejala OCD sejak dini untuk mendapatkan penanganan yang tepat waktu</p>
                </div>
                
                <div class="bg-green-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Assessment Terstruktur</h3>
                    <p class="text-gray-600">Tes berdasarkan standar assessment yang terpercaya dan valid</p>
                </div>
                
                <div class="bg-purple-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Hasil Instan</h3>
                    <p class="text-gray-600">Dapatkan hasil dan rekomendasi segera setelah menyelesaikan tes</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Memulai Perjalanan Kesehatan Mental Anda?</h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">Daftar sekarang dan lakukan tes skrining OCD secara gratis dan rahasia</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="register.php" class="bg-white text-indigo-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                    Daftar Sekarang
                </a>
                <a href="login.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-indigo-600 transition duration-300">
                    Login
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">OCD Detector</h3>
                <p class="text-gray-400 mb-4">Platform deteksi dini gejala OCD untuk kesehatan mental yang lebih baik</p>
                <p class="text-gray-500 text-sm">&copy; 2024 OCD Detector. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animasi fade in
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-fade-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>