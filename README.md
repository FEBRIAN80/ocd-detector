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
## Catatan

- Database port default MySQL: 3306 (dapat dikonfigurasi di `config/database.php`)
- Tailwind CSS di-compile ke `assets/css/style.css` - jangan edit file ini, edit `assets/css/input.css` saja
- Untuk production, pastikan environment variables aman
- Jangan expose `config/database.php` credentials ke repository

## Author

Febrian - OCD Detection System
