<<<<<<< HEAD
# 📚 Sistem Absensi Berbasis RFID

[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-red.svg)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![PWA](https://img.shields.io/badge/PWA-Ready-orange.svg)](https://web.dev/progressive-web-apps/)

Sistem manajemen absensi siswa modern berbasis teknologi RFID dengan antarmuka web yang responsif dan fitur Progressive Web App (PWA). Dirancang khusus untuk institusi pendidikan yang membutuhkan sistem pencatatan kehadiran yang akurat, otomatis, dan mudah dikelola.

## ✨ Fitur Utama

### 🎯 Sistem Absensi
- **Absensi RFID Otomatis** - Pencatatan kehadiran real-time menggunakan kartu RFID
- **Multi-Status Kehadiran** - Hadir, Izin, Sakit, Alpha dengan timestamp akurat
- **Validasi Waktu** - Kontrol jam masuk dan keluar sesuai jadwal sekolah
- **Laporan Kehadiran** - Laporan harian, mingguan, dan bulanan yang komprehensif

### 👥 Manajemen Siswa
- **Database Siswa Lengkap** - Profil siswa dengan foto dan informasi detail
- **Manajemen Rombel** - Organisasi siswa berdasarkan rombongan belajar
- **Import/Export Data** - Dukungan format Excel untuk transfer data massal
- **Sistem Poin** - Tracking poin kedisiplinan siswa

### 📊 Dashboard & Laporan
- **Dashboard Interaktif** - Visualisasi data kehadiran real-time
- **Laporan Multi-Format** - Export ke PDF, Excel, dan format lainnya
- **Statistik Kehadiran** - Analisis tren kehadiran per siswa/kelas
- **Notifikasi Otomatis** - Alert untuk ketidakhadiran dan pelanggaran

### 🔧 Fitur Administratif
- **Manajemen User** - Role-based access control (Admin, Guru, Wali Kelas)
- **Pengaturan Sistem** - Konfigurasi jam sekolah, hari libur, dan parameter lainnya
- **Backup & Restore** - Sistem backup otomatis untuk keamanan data
- **Audit Trail** - Log aktivitas sistem untuk tracking perubahan

### 📱 Progressive Web App (PWA)
- **Offline Capability** - Akses terbatas saat tidak ada koneksi internet
- **Responsive Design** - Optimal di desktop, tablet, dan smartphone
- **Install ke Device** - Dapat diinstall seperti aplikasi native
- **Push Notifications** - Notifikasi real-time untuk update penting

## 🛠️ Teknologi yang Digunakan

- **Backend Framework**: CodeIgniter 4.x
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap
- **PWA**: Service Worker, Web App Manifest
- **Export/Import**: PhpSpreadsheet
- **Hardware**: RFID Reader (RC522 atau kompatibel)

## 📋 Persyaratan Sistem

### Server Requirements
- **PHP**: 7.4 atau lebih tinggi
- **Database**: MySQL 5.7+ atau MariaDB 10.3+
- **Web Server**: Apache 2.4+ atau Nginx 1.18+
- **Extensions**: 
  - php-intl
  - php-json
  - php-mbstring
  - php-mysqli
  - php-curl
  - php-gd (untuk manipulasi gambar)

### Hardware Requirements
- **RFID Reader**: RC522 atau kompatibel
- **Kartu RFID**: Mifare Classic 1K atau kompatibel
- **Minimum RAM**: 512MB
- **Storage**: 1GB ruang kosong

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/username/Absensi-Berbasis-RFID.git
cd Absensi-Berbasis-RFID
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
CI_ENVIRONMENT = production

database.default.hostname = localhost
database.default.database = absensi
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
```

### 4. Setup Database
```bash
# Import database
mysql -u username -p absensi < db/absensi.sql

# Atau menggunakan phpMyAdmin
# Import file db/absensi.sql melalui interface phpMyAdmin
```

### 5. Set Permissions
```bash
chmod -R 755 writable/
chmod -R 755 public/
```

### 6. Konfigurasi Web Server

#### Apache (.htaccess sudah disediakan)
Pastikan mod_rewrite aktif:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Nginx
Tambahkan konfigurasi berikut ke server block:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## 🎮 Penggunaan

### Login Sistem
1. Akses aplikasi melalui browser: `http://your-domain.com`
2. Login menggunakan kredensial default:
   - **Username**: admin
   - **Password**: admin123
3. Ubah password default setelah login pertama

### Setup RFID Hardware
1. Hubungkan RFID Reader ke sistem
2. Konfigurasi port komunikasi di menu Settings
3. Test koneksi hardware melalui menu Diagnostics

### Manajemen Data Siswa
1. **Import Data**: Gunakan template Excel di `public/file/format_import_siswa.xls`
2. **Registrasi RFID**: Tap kartu RFID pada reader untuk mendaftarkan ke siswa
3. **Foto Siswa**: Upload foto melalui menu profil siswa

### Monitoring Absensi
1. **Real-time**: Monitor kehadiran melalui dashboard utama
2. **Laporan**: Generate laporan melalui menu Reports
3. **Export**: Download laporan dalam format PDF/Excel

## 📁 Struktur Direktori

```
Absensi-Berbasis-RFID/
├── app/
│   ├── Controllers/          # Controller aplikasi
│   ├── Models/              # Model database
│   ├── Views/               # Template views
│   └── Config/              # Konfigurasi aplikasi
├── public/
│   ├── template/            # Assets CSS/JS
│   ├── image/               # Upload gambar
│   └── file/                # File template
├── db/
│   └── absensi.sql          # Database schema
├── writable/                # Cache & logs
└── system/                  # CodeIgniter core
```

## 🔧 Konfigurasi Lanjutan

### PWA Settings
Edit `public/manifest.json` untuk menyesuaikan:
- Nama aplikasi
- Icon aplikasi
- Warna tema
- Orientasi layar

### Notifikasi Push
Konfigurasi service worker di `public/sw.js` untuk:
- Cache strategy
- Background sync
- Push notifications

### Backup Otomatis
Setup cron job untuk backup database:
```bash
# Tambahkan ke crontab
0 2 * * * mysqldump -u username -p password absensi > /backup/absensi_$(date +\%Y\%m\%d).sql
```

## 🤝 Kontribusi

Kami menyambut kontribusi dari komunitas! Silakan:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Guidelines Kontribusi
- Ikuti coding standards CodeIgniter 4
- Tambahkan unit tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Pastikan tidak ada breaking changes

## 📝 Changelog

### v2.0.0 (2024-11-12)
- ✨ Implementasi Progressive Web App (PWA)
- 🔧 Upgrade ke CodeIgniter 4.x
- 📊 Dashboard baru dengan visualisasi data
- 🔐 Peningkatan sistem keamanan
- 📱 Responsive design untuk mobile

### v1.5.0 (2024-10-15)
- 📈 Sistem poin kedisiplinan siswa
- 📋 Export laporan ke multiple format
- 🔔 Notifikasi real-time
- 🛠️ Perbaikan bug dan optimasi performa

## 🐛 Troubleshooting

### Masalah Umum

**RFID Reader tidak terdeteksi**
```bash
# Cek port serial
ls /dev/ttyUSB*
# Pastikan permission correct
sudo chmod 666 /dev/ttyUSB0
```

**Database connection error**
- Periksa kredensial database di file `.env`
- Pastikan MySQL service berjalan
- Cek firewall settings

**PWA tidak bisa diinstall**
- Pastikan HTTPS aktif (required untuk PWA)
- Cek service worker registration
- Validasi manifest.json

### Log Files
- **Application Logs**: `writable/logs/`
- **Error Logs**: Check web server error logs
- **Database Logs**: MySQL slow query log

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE) - lihat file LICENSE untuk detail lengkap.

## 👨‍💻 Tim Pengembang

- **Lead Developer**: [Nama Developer]
- **UI/UX Designer**: [Nama Designer]
- **Hardware Integration**: [Nama Engineer]

## 📞 Dukungan

Butuh bantuan? Hubungi kami:

- 📧 **Email**: support@example.com
- 💬 **WhatsApp**: +62-xxx-xxxx-xxxx
- 🌐 **Website**: https://example.com
- 📋 **Issues**: [GitHub Issues](https://github.com/username/Absensi-Berbasis-RFID/issues)

## 🙏 Acknowledgments

- [CodeIgniter](https://codeigniter.com/) - PHP Framework
- [Bootstrap](https://getbootstrap.com/) - CSS Framework
- [PhpSpreadsheet](https://phpspreadsheet.readthedocs.io/) - Excel Processing
- [Chart.js](https://www.chartjs.org/) - Data Visualization

---

⭐ **Jika proyek ini membantu Anda, berikan star di GitHub!**

📢 **Follow kami untuk update terbaru dan proyek menarik lainnya!**
=======
# Absensi Berbasis RFID

Aplikasi sistem absensi menggunakan **RFID** yang terintegrasi dengan  **Website berbasis PHP & MySQL**.  
Sistem ini dirancang untuk mempermudah proses pencatatan kehadiran secara otomatis, cepat, dan akurat.

## 🎯 Fitur Utama
- Scan kartu RFID untuk absensi otomatis
- Penyimpanan data ke database MySQL
- Manajemen data siswa/i
- Riwayat absensi & laporan
- Dashboard admin berbasis web

## 🛠️ Teknologi yang Digunakan
- Alat RFID
- PHP
- Codeignaiter
- phpmyadmin
- XAMPP

## 🚀 Cara Menjalankan
1. PHP > 8.0
2. Install Composer
4. Import database `absensi_rfid.sql`
5. running terminal php spark serve
6. buka browser "http://localhost:8080"
7. Akses melalui browser

## 👤 Author
**Tri Bintang Saputra**  
Project Akademik / Portofolio
>>>>>>> 0cf2ba1119840a9bedc801012003f34f49124a07
