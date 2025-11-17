# Website Deteksi Dini OCD

Website untuk melakukan tes skrining awal gejala Obsessive Compulsive Disorder (OCD) menggunakan PHP Native, MySQL, dan Tailwind CSS.

## Fitur

- **Landing Page** yang informatif dan menarik
- **Sistem Registrasi & Login** user dengan password hashing
- **Kuesioner OCD** 10 pertanyaan dengan skala 0-4
- **Perhitungan Skor Otomatis** dengan kategori hasil
- **Visualisasi Hasil** menggunakan Chart.js
- **Invoice Generator** untuk mendownload hasil test
- **Dashboard Admin** untuk melihat semua hasil user dengan statistik
- **Responsive Design** menggunakan Tailwind CSS
- **Global Header/Footer System** untuk maintenance mudah

## Teknologi

- **Backend**: PHP Native (tanpa framework)
- **Database**: MySQL dengan MySQLi
- **Frontend**: Vanilla JavaScript
- **CSS Framework**: Tailwind CSS (local build dengan npm)
- **Visualization**: Chart.js
- **Build Tool**: npm (Tailwind CSS)

## Instalasi

### Prerequisites
- PHP 7.4+
- MySQL 5.7+
- Node.js & npm (untuk Tailwind CSS)
- Web Server (Apache, Nginx, atau Laragon)

### Setup

1. **Clone atau download project ini**
   ```bash
   git clone https://github.com/FEBRIAN80/ocd-detector.git
   cd ocd-detector
   ```

2. **Install Node dependencies dan build Tailwind CSS**
   ```bash
   npm install
   npm run tailwind
   ```

3. **Setup Database:**
   - Buat database `ocd_detection` di MySQL
   - Import file database (jika ada)
   - Atau buat tabel secara manual sesuai struktur di `config/database.php`

4. **Konfigurasi koneksi database:**
   - Edit file `config/database.php`
   - Sesuaikan host, username, password database
   - Port MySQL default: 3306 (atau sesuaikan dengan setup Anda)

5. **Jalankan di web server:**
   - Letakkan folder project di htdocs (XAMPP) atau www (Laragon)
   - Akses melalui browser: `http://localhost/ocd-website`

## Akses Default

**Admin Login:**
- Username: `admin`
- Password: `admin123`

**User Pages:**
- Registrasi baru di `/register.php`
- Login di `/login.php`

## Kategori Hasil

| Skor | Kategori | Deskripsi |
|------|----------|-----------|
| 0-7 | Sangat Ringan | Gejala minimal, tidak mengganggu aktivitas |
| 8-15 | Ringan | Beberapa gejala, masih dapat dikelola |
| 16-23 | Sedang | Gejala mulai mengganggu beberapa aspek |
| 24-31 | Cukup Berat | Gejala berat, disarankan konsultasi |
| 32-40 | Sangat Berat | Gejala sangat berat, segera konsultasi profesional |

## Development

### Tailwind CSS Watch Mode
Untuk development dengan auto-rebuild CSS:
```bash
npm run tailwind:watch
```
## Fitur Halaman

### Landing Page (`index.php`)
- Pengenalan aplikasi
- CTA untuk register/login
- Informasi tentang OCD
- Link ke halaman login user/admin

### Kuesioner (`kuesioner.php`)
- 10 pertanyaan OCD
- Progress bar real-time
- Validasi form sebelum submit
- Skala jawaban 0-4 (Tidak Pernah - Sangat Sering)

### Hasil Test (`hasil.php`)
- Menampilkan skor total
- Kategori dan penjelasan hasil
- Chart visualisasi skor
- Tombol download invoice
- Opsi untuk test ulang

### Download Invoice (`download_invoice.php`)
- Generate laporan professional PDF-ready
- Informasi pasien lengkap
- Detail jawaban per pertanyaan
- Trigger print dialog browser
- Save as PDF functionality

### Admin Dashboard (`admin/dashboard.php`)
- Statistik pengguna
- Chart distribusi kategori
- Tabel daftar hasil test semua user
- Sorting berdasarkan skor

## Security

- Password hashing menggunakan `password_hash()` dan `password_verify()`
- Session management untuk user dan admin
- Input escaping menggunakan `escape_string()`
- Login validation pada setiap protected page

## Catatan

- Database port default MySQL: 3306 (dapat dikonfigurasi di `config/database.php`)
- Tailwind CSS di-compile ke `assets/css/style.css` - jangan edit file ini, edit `assets/css/input.css` saja
- Untuk production, pastikan environment variables aman
- Jangan expose `config/database.php` credentials ke repository

## Author

Febrian - OCD Detection System
