# Sipinjam

Sebuah platform manajemen peminjaman buku perpustakaan modern yang dibangun dengan CodeIgniter 4 dan Tailwind CSS. Proyek ini dirancang untuk mempermudah proses administrasi perpustakaan dan memberikan pengalaman peminjaman yang seamless bagi anggota (mahasiswa).

## 🚀 Fitur Utama (User Side)

Smart Catalog: Eksplorasi koleksi buku dengan fitur pencarian dan filter kategori yang cepat.

Real-time Monitoring: Pantau buku yang sedang dipinjam dengan indikator countdown jatuh tempo otomatis.

Self-Service Extension: Fitur perpanjangan durasi pinjam secara mandiri (sesuai kebijakan).

Waitlist Reservation: Sistem reservasi (booking) otomatis jika stok buku sedang kosong.

Notification System: Notifikasi pengingat pengembalian dan info ketersediaan buku reservasi.

## 🛠️ Tech Stack

Backend: PHP 8.x (Framework CodeIgniter 4)

Frontend: Tailwind CSS & Vanilla JavaScript

Database: MySQL / MariaDB

Tools: Composer, GitHub

## 📂 Struktur Proyek (MVC)

Proyek ini mengikuti standar arsitektur Model-View-Controller (MVC) dari CodeIgniter 4 untuk memastikan kode yang bersih dan mudah dikelola (clean code).

Plaintext
├── app/
│ ├── Controllers/ # Logika bisnis aplikasi
│ ├── Models/ # Interaksi dengan database
│ └── Views/ # Tampilan (User & Admin)
├── public/ # Aset publik (CSS, JS, Images)
└── writable/ # Folder cache dan logs

## ⚙️ Cara Instalasi

Clone repositori ini:

Bash
git clone https://github.com/username/repo-name.git
Instal dependensi melalui Composer:

Bash
composer install
Salin file env ke .env dan sesuaikan konfigurasi database:

Bash
cp env .env
Jalankan migrasi database:

Bash
php spark migrate
Jalankan server lokal:

Bash
php spark serve

Untuk development harian, jalankan satu perintah ini agar server CodeIgniter dan Tailwind watcher aktif bersamaan:

Bash
npm install
npm run dev

Jika hanya ingin build CSS satu kali tanpa mode watch:

Bash
npm run build:css

## 🎨 Palet Warna & Desain

Website ini menggunakan skema warna profesional:

Primary Blue: #237FEA

Background: #FFFFFF

Typography: Inter / Plus Jakarta Sans
