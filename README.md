<div align="center">

# Portal Resmi Fakultas Ilmu Kesehatan & Humas
### Universitas Ibnu Sina (FIKES UIS) — Batam

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-046B26?style=for-the-badge)](LICENSE)

Portal informasi publik, layanan akademik, kemahasiswaan, publikasi riset, kehumasan, serta sistem manajemen konten (CMS) terintegrasi untuk **Fakultas Ilmu Kesehatan (FIKES) Universitas Ibnu Sina**.

</div>

---

## Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Hak Akses & Role Pengguna](#-hak-akses--role-pengguna)
- [Prasyarat Sistem](#-prasyarat-sistem)
- [Panduan Instalasi](#-panduan-instalasi)
- [Akun Default (Seeder)](#-akun-default-seeder)
- [Sistem Backup Database & Storage](#-sistem-backup-database--storage)
- [Struktur Direktori](#-struktur-direktori)
- [Pengujian (Testing)](#-pengujian-testing)

---

## Tentang Proyek

**Web FIKES UIS** adalah platform portal web modern yang dirancang untuk memenuhi kebutuhan publikasi akademik, kemahasiswaan, informasi program studi, serta pusat layanan kehumasan. Dilengkapi dengan **Panel Dashboard Administrator** berbasis *Multi-Role* yang memudahkan pengelolaan konten secara dinamis, *real-time*, dan responsif.

---

## Fitur Utama

### 1. Portal Publik (Frontend)
- **Beranda Interaktif**: Hero banner *carousel*, akses cepat **Layanan Terkait** (SIAKAD, SISTER, SINTA, Edlink, dll.), profil singkat & video profil, statistik kampus (*counter animation*), serta direktori fakultas & program studi.
- **Profil Institusi**: Halaman Tentang, Visi & Misi, Sambutan Pimpinan, Struktur Organisasi, serta Sejarah & *Milestone* perjalanan institusi.
- **Akademik & Program Studi**:
  - Informasi lengkap Program Studi (`S2 Kesehatan Masyarakat`, `S1 Kesehatan & Keselamatan Kerja (K3)`, `S1 Kesehatan Lingkungan`).
  - Kurikulum per semester dilengkapi unduhan dokumen **RPS**, Kalender Akademik, Pedoman Akademik, dan Sistem Akademik.
  - Direktori Dosen & Tenaga Pengajar lengkap dengan filter Program Studi, pencarian NIDN/NUPTK, jabatan fungsional, serta tautan profil publikasi.
- **Kemahasiswaan & Alumni**:
  - **Prestasi Mahasiswa**: *Hall of Fame* capaian mahasiswa tingkat Provinsi, Nasional, dan Internasional.
  - **Organisasi Mahasiswa (Ormawa)**: *3D Cascading Deck Showcase*, profil lembaga, kepengurusan, visi-misi, dan tautan pendaftaran (*open recruitment*).
  - **Portal Alumni & Testimoni**: Analitik distribusi bintang penilaian serta formulir pengiriman testimoni publik dengan moderasi admin.
- **Informasi, Berita & Layanan Humas**:
  - Portal berita & pengumuman dengan pencarian *live AJAX*, filter kategori, serta galeri multi-foto.
  - Pusat Layanan Humas: **Unduhan Dokumen**, **Desain Grafis**, **Template Dokumen**, **E-Magazine Humas**, **Permintaan Rilis Berita**, **Pendampingan Acara**, dan **Survey Layanan**.
  - Integrasi *feed* Media Sosial (Instagram, YouTube, TikTok) dan Pusat Bantuan (**FAQ**).
- **Multi-Bahasa (Multi-Language)**: Dukungan pengaturan terjemahan bahasa untuk pengunjung internasional.

### 2. Panel Manajemen Konten (Dashboard Admin)
- **Dashboard Analitik**: Visualisasi grafik tren publikasi berita, komposisi organisasi mahasiswa, dan radar *rating* testimoni menggunakan **ApexCharts**.
- **Server-Side DataTables**: Seluruh tabel manajemen data dilengkapi pencarian instan, *sorting*, paginasi, serta ekspor **Excel, CSV, PDF, dan Print** menggunakan **Yajra DataTables**.
- **Import & Export Excel**: Dukungan *bulk import* data Dosen dan Berita menggunakan *template* Excel (`PhpSpreadsheet`).
- **Rich Text Editor**: Integrasi **TinyMCE 6** dengan fitur *image upload handler* langsung ke penyimpanan server.
- **Pusat Backup Database & Storage**:
  - Ekspor database MySQL (`.sql`) via `mysqldump` dengan *fallback* otomatis ke *Native PDO Exporter*.
  - Kompresi berkas media `storage/app/public` ke arsip `.zip`.
  - Penjadwalan backup harian otomatis setiap pukul `01:00 WIB` serta skrip `.bat` untuk *Auto-Sync* dari server/cPanel ke Laptop (`Drive D:` / `Drive C:`) tanpa memerlukan Google Drive.

---

## Teknologi yang Digunakan

| Kategori | Teknologi / Paket |
| :--- | :--- |
| **Framework Backend** | Laravel 12.x (PHP 8.2+) |
| **Database** | MySQL / MariaDB |
| **Frontend & UI** | Blade Templates, Bootstrap 5.3, Bootstrap Icons, AOS (Animate On Scroll), Swiper.js |
| **DataTables** | `yajra/laravel-datatables` ^12.0 |
| **Spreadsheet Engine** | `phpoffice/phpspreadsheet` ^5.9 |
| **Notifikasi & Alert** | `realrashid/sweet-alert` ^7.3 (SweetAlert2) |
| **Visualisasi Grafik** | ApexCharts.js |
| **Rich Text Editor** | TinyMCE 6.8 |
| **Asset Bundler** | Vite |

---

## Hak Akses & Role Pengguna

Sistem menggunakan autentikasi berbasis *multi-role* yang dikontrol melalui middleware `Checkrole`:

| Role | Hak Akses Modul |
| :--- | :--- |
| **Super Administrator (`admin`)** | Akses penuh ke seluruh modul profil, akademik, program studi, dosen, kemahasiswaan, humas, pengaturan beranda, manajemen pengguna, dan backup sistem. |
| **Penulis Berita (`penulis`)** | Mengelola dan menerbitkan artikel berita, pengumuman, serta galeri dokumentasi. |
| **Pengurus Ormawa (`organisasi`)** | Mengelola profil organisasi kemahasiswaan, struktur kepengurusan, foto kegiatan, dan tautan pendaftaran anggota baru. |

---

## Prasyarat Sistem

Pastikan lingkungan pengembangan atau server Anda memenuhi spesifikasi berikut:

- **PHP** >= 8.2 (dengan ekstensi `pdo_mysql`, `mbstring`, `zip`, `gd`, `xml`, `curl`, `fileinfo`, `openssl`)
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM**
- **MySQL** >= 8.0 atau **MariaDB** >= 10.6
- Web Server: Apache / Nginx / Laragon

---

## Panduan Instalasi

1. **Clone Repositori**
   ```bash
   git clone https://github.com/dimaspradipto1/webfikes.git
   cd webfikes
   ```

2. **Instal Dependensi PHP & Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan buat *application key*:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database di `.env`**
   Sesuaikan kredensial database pada file `.env`:
   ```env
   APP_NAME="FIKES UIS"
   APP_URL=http://webfikes.test

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=webfikes
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi & Seeder Database**
   ```bash
   php artisan migrate --seed
   ```

6. **Buat Symbolic Link Storage**
   ```bash
   php artisan storage:link
   ```

7. **Build Aset Frontend & Jalankan Server**
   ```bash
   npm run build
   php artisan serve
   ```
   Atau gunakan mode pengembangan terpadu:
   ```bash
   composer run dev
   ```

---

## Akun Default (Seeder)

Setelah menjalankan `php artisan db:seed`, Anda dapat masuk melalui halaman `/login` menggunakan kredensial berikut:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@gmail.com` | `password` |
| **Penulis Berita** | `penulis@gmail.com` | `password` |
| **Pengguna Umum** | `user@gmail.com` | `password` |

> **Catatan Keamanan:** Segera ubah password akun default melalui menu **Profil Akun** atau **Manajemen Pengguna** saat aplikasi di-*deploy* ke server produksi.

---

## Sistem Backup Database & Storage

Proyek ini memiliki modul pencadangan mandiri yang dapat diakses melalui menu **Pengaturan & Administrator -> Backup Database & Storage** (`/admin-backup`) atau melalui CLI:

### Eksekusi via Terminal (Artisan Command)
```bash
# Backup Database (.sql) dan Storage (.zip) sekaligus
php artisan system:backup --type=all

# Backup hanya Database MySQL
php artisan system:backup --type=database --name=sebelum-update

# Backup hanya Storage Media
php artisan system:backup --type=storage
```

### Lokasi Penyimpanan Default
- **Windows (Lokal)**: Otomatis mendeteksi `D:\website fikes` (atau beralih ke `C:\website fikes` apabila Drive D: tidak tersedia).
- **Linux / cPanel Hosting**: Otomatis disimpan di luar `public_html` (atau di `storage/app/backups/website fikes`).
- Dapat dikustomisasi kapan saja melalui variabel `.env`:
  ```env
  BACKUP_DIRECTORY="D:\website fikes"
  BACKUP_SYNC_TOKEN="token-rahasia-sinkronisasi-anda"
  ```

### Jadwal Otomatis (Cron Job / Task Scheduler)
- **cPanel / Linux Cron**:
  ```bash
  * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
  ```
- **Windows Task Scheduler**: Jalankan file [`backup-daily.bat`](backup-daily.bat) atau unduh skrip **Auto-Sync ke Laptop (`.bat`)** langsung dari halaman dashboard Backup.

---

## Struktur Direktori

```text
webfikes/
├── app/
│   ├── Console/Commands/       # Artisan command (SystemBackupCommand)
│   ├── DataTables/             # Kelas konfigurasi Yajra DataTables
│   ├── Http/
│   │   ├── Controllers/        # Controller Frontend & Admin Dashboard
│   │   ├── Middleware/         # Middleware autentikasi & multi-role (Checkrole)
│   │   └── Requests/           # Form Request Validation
│   ├── Models/                 # Model Eloquent ORM
│   └── Services/               # Business logic services (BackupService, FileUploadService)
├── database/
│   ├── migrations/             # Skema tabel database
│   └── seeders/                # Data awal aplikasi
├── public/
│   ├── assets/                 # Aset dashboard administrator
│   └── frontend/               # Aset CSS, JS, dan gambar halaman publik
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── auth/           # Tampilan halaman Login
│       │   ├── dashboard/      # Template utama, Header, Sidebar & Index Dashboard
│       │   └── frontend/       # Halaman-halaman publik (Homepage, Berita, Humas, dll.)
│       └── pages/              # Halaman CRUD modul-modul di panel Admin
├── routes/
│   ├── console.php             # Penjadwalan tugas otomatis (Schedule)
│   └── web.php                 # Definisi rute publik, autentikasi, admin, dan API sync
└── backup-daily.bat            # Skrip eksekusi backup harian untuk Windows
```

---

## Pengujian (Testing)

Untuk menjalankan rangkaian *Unit Test* dan *Feature Test*:

```bash
php artisan test
```

---

<div align="center">
  <sub>Hak Cipta © {{ date('Y') }} <strong>Fakultas Ilmu Kesehatan — Universitas Ibnu Sina (UIS) Batam</strong>. Seluruh hak cipta dilindungi.</sub>
</div>
