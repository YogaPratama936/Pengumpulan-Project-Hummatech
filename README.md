✈️ SkyLinee — Aplikasi Pemesanan Tiket Pesawat Berbasis Web

SkyLinee adalah aplikasi pemesanan tiket pesawat domestik berbasis web yang dirancang untuk mempermudah pengguna dalam mencari jadwal penerbangan, memantau ketersediaan kursi secara real-time, serta melakukan pemesanan tiket secara cepat, aman, dan efisien.

Aplikasi ini dikembangkan menggunakan Laravel Framework dengan pola arsitektur MVC (Model–View–Controller) dan didukung Tailwind CSS untuk menghasilkan antarmuka yang modern, responsif, dan nyaman digunakan.


---

🚀 Fitur Utama

1. Autentikasi Pengguna

Registrasi dan Login Akun
Menyediakan sistem autentikasi untuk menjaga keamanan data pengguna menggunakan mekanisme keamanan bawaan Laravel.

Middleware Authentication (auth)
Membatasi akses ke halaman dashboard dan fitur pemesanan hanya untuk pengguna yang telah melakukan login.



---

2. Pencarian Penerbangan (Sisi Publik)

Pencarian Penerbangan Dinamis
Pengguna dapat mencari penerbangan berdasarkan bandara asal, tujuan, dan tanggal keberangkatan.

Informasi Ketersediaan Real-Time
Menampilkan jadwal penerbangan, nomor penerbangan, sisa kursi tersedia, dan estimasi harga secara transparan.



---

3. Dashboard Transaksi Pengguna (Sisi Privat)

Riwayat Pemesanan
Menampilkan daftar seluruh transaksi pemesanan lengkap dengan kode booking unik (BK-YYYYMMDD-XXXX).

Boarding Pass Digital & QR Code
Sistem menghasilkan tiket elektronik berupa boarding pass digital yang dilengkapi QR Code untuk proses verifikasi.

Status Transaksi
Menampilkan status pembayaran dan pemesanan secara dinamis seperti:

PENDING

SUCCESS




---

🛠️ Teknologi yang Digunakan

Komponen	Teknologi

Backend	Laravel 11 / PHP
Frontend	Tailwind CSS v4
Database	SQLite / MySQL
Arsitektur	MVC (Model–View–Controller)
UI & Ikon	Font Awesome, Google Fonts (Plus Jakarta Sans & Inter)



---

📁 Struktur Database

Aplikasi menggunakan sistem database relasional dengan 5 tabel utama:

1. users

Menyimpan data akun pengguna seperti nama, email, dan password.

2. airports

Menyimpan data master bandara seperti nama kota dan kode bandara (contoh: CGK, UPG, DPS).

3. flights

Menyimpan informasi jadwal penerbangan, nomor penerbangan, relasi bandara asal–tujuan, kapasitas kursi, waktu keberangkatan, waktu kedatangan, serta harga tiket.

4. bookings

Menyimpan data transaksi pemesanan yang menghubungkan pengguna dengan penerbangan menggunakan kode booking unik.

5. payments

Mengelola data pembayaran dan status transaksi untuk setiap pemesanan.


---

🎯 Tujuan Pengembangan

SkyLinee dibuat untuk memberikan pengalaman pemesanan tiket pesawat yang mudah, cepat, modern, dan terintegrasi dalam satu platform berbasis web.
