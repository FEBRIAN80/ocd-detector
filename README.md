# Website Deteksi Dini OCD

Website untuk melakukan tes skrining awal gejala Obsessive Compulsive Disorder (OCD) menggunakan PHP Native, MySQL, dan Tailwind CSS.

## Fitur

- **Landing Page** yang informatif dan menarik
- **Sistem Registrasi & Login** user
- **Kuesioner OCD** 10 pertanyaan dengan skala 0-4
- **Perhitungan Skor Otomatis** dengan kategori hasil
- **Visualisasi Hasil** menggunakan Chart.js
- **Dashboard Admin** untuk melihat semua hasil user
- **Responsive Design** menggunakan Tailwind CSS

## Teknologi

- PHP Native (tanpa framework)
- MySQL Database
- JavaScript (Vanilla)
- Tailwind CSS
- Chart.js

## Instalasi

1. **Clone atau download project ini**
2. **Import database:**
   - Buat database `ocd_detection`
   - Import file `ocd_website.sql` ke database Anda
3. **Konfigurasi koneksi database:**
   - Edit file `config/database.php`
   - Sesuaikan host, username, password database
4. **Jalankan di web server:**
   - Letakkan folder project di htdocs (XAMPP) atau www (Laragon)
   - Akses melalui browser: `http://localhost/ocd-website`

##  Akses Default

**Admin Login:**
- Username: `admin`
- Password: `admin123`

##  Kategori Hasil

- **0-7**: Sangat Ringan
- **8-15**: Ringan  
- **16-23**: Sedang
- **24-31**: Cukup Berat
- **32-40**: Sangat Berat
