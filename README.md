# Sistem Informasi Manajemen Tata Kelola RT/RW (SIM-TRW)

![Status: Aktif](https://img.shields.io/badge/Status-Aktif-success)
![Lisensi: MIT](https://img.shields.io/badge/Lisensi-MIT-blue)

Sistem Informasi Manajemen Tata Kelola RT/RW (SIM-TRW) adalah sebuah platform berbasis web yang dikembangkan sebagai bagian dari program **Pengabdian kepada Masyarakat (PkM)** oleh **Jurusan Teknologi Informasi, Politeknik Negeri Jember (Polije)**.

Platform ini bertujuan untuk mendigitalisasi dan mempermudah tata kelola administrasi di lingkungan rukun tetangga dan rukun warga, guna mewujudkan lingkungan yang tertib, transparan, dan modern.

## 🌟 Fitur Utama

Proyek ini memiliki tiga pilar sistem utama untuk melayani kebutuhan administrasi warga:

1. **Sistem Pendataan Mobilitas Warga (Keluar/Masuk)**
   * Pencatatan warga pindah datang dan pindah keluar.
   * Pencatatan tamu yang menginap lebih dari 1x24 jam.
   * Pemantauan demografi warga secara *real-time*.

2. **Sistem Informasi Iuran Warga**
   * Pencatatan transparansi kas RT/RW.
   * Tagihan iuran bulanan warga (keamanan, kebersihan, dll).
   * Konfirmasi dan riwayat pembayaran bagi warga.
   * Laporan rekapitulasi iuran tunggak dan lunas.

3. **Sistem Pembuatan Surat & Dokumen**
   * Pengajuan mandiri oleh warga (Surat Pengantar RT/RW, Surat Keterangan Domisili, dll).
   * Verifikasi dan persetujuan (Acc) digital berjenjang dari RT hingga RW.
   * Cetak dokumen otomatis dengan format yang sudah distandarisasi.

## 👥 Hak Akses & Peran (Role)

Sistem ini didesain dengan manajemen multi-pengguna yang membagi hak akses ke dalam 4 peran:

### 1. Admin
* Memiliki akses penuh terhadap seluruh fitur dan konfigurasi sistem.
* Mengelola data master (Master Data RT, RW, Kategori Iuran, Jenis Surat).
* Melakukan manajemen *user* dan *reset password*.
* Melakukan *maintenance* dan *backup* data basis data.

### 2. Ketua RW
* Mengakses *dashboard* rekapitulasi demografi warga di seluruh RW.
* Menyetujui dan menandatangani pengajuan dokumen tingkat RW secara digital.
* Memantau laporan keuangan dan iuran lintas RT di bawah wilayah RW.
* Melihat log pendataan keluar masuk warga secara keseluruhan.

### 3. Ketua RT
* Mengelola data warga khusus pada wilayah RT-nya masing-masing.
* Menyetujui (Verifikasi) pengajuan surat keterangan dari warga di RT-nya.
* Memantau dan menagih status pembayaran iuran warga RT-nya.
* Mencatat warga pindah, datang, dan tamu di wilayah RT-nya.

### 4. Warga
* Memperbarui profil data keluarga (Kartu Keluarga) dan anggota keluarga.
* Mengajukan permintaan pembuatan surat/dokumen administrasi ke RT/RW secara daring.
* Mengecek tagihan iuran bulanan dan mengunggah bukti pembayaran.
* Melaporkan tamu menginap atau anggota keluarga yang pindah keluar/masuk.

## 🛠️ Teknologi yang Digunakan

* **Backend**: PHP 8.x / Laravel 12
* **Frontend**: HTML5, CSS3, Bootstrap 5 / Tailwind CSS
* **Database**: MySQL / MariaDB
* **Aplikasi Mobile**: Flutter
* **Library Tambahan**: DataTables, DomPDF (untuk cetak dokumen), Chart.js (untuk grafik pelaporan)

## 🚀 Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

1. **Clone repositori**
   ```bash
   git clone https://github.com/djuliar/gpi.my.id.git
   cd gpi.my.id

 2. **Instal dependensi** (Jika menggunakan Composer/Laravel)
   ```bash
   composer install
   npm install
   
   ```
 3. **Konfigurasi Environment**
   Salin file .env.example menjadi .env dan atur konfigurasi *database*:
   ```bash
   cp .env.example .env
   
   ```
   *Atur detail koneksi database di file .env.*
 4. **Generate Key & Migrasi Database**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   
   ```
   *Catatan: Flag --seed akan memasukkan data kredensial default untuk Admin, Ketua RW, Ketua RT, dan Warga.*
 5. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   
   ```
   Akses aplikasi di http://localhost:8000.

## 📜 Kredensial Default (Testing)
Gunakan akun berikut untuk menguji *role* masing-masing saat *development*:
| Role | Username / Email | Password |
|---|---|---|
| Admin | admin@gpi.my.id | password123 |
| Ketua RW | rw01@gpi.my.id | password123 |
| Ketua RT | rt01@gpi.my.id | password123 |
| Warga | warga@gpi.my.id | password123 |

## 🤝 Ucapan Terima Kasih & Kontributor
Proyek ini dikembangkan dalam rangka Pengabdian kepada Masyarakat (PkM) oleh:
 * **Tim Dosen Jurusan Teknologi Informasi**
 * **Mahasiswa Jurusan Teknologi Informasi**
 * **Politeknik Negeri Jember**
sebagai wujud kontribusi akademisi terhadap digitalisasi dan tata kelola lingkungan masyarakat. Jika terdapat kendala atau laporan *bug* selama masa implementasi di lingkungan warga, silakan buat laporan pada menu *Issues* di repositori ini.

*Dibuat dengan ❤️ untuk masyarakat oleh Civitas Akademika Polije.*
