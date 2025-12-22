# 🌽 MOZU - Aplikasi Jasuke Mozarella

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=flat&logo=tailwind-css)

Aplikasi pemesanan digital untuk usaha **Jasuke Mozarella** dengan sistem pembayaran manual dan integrasi QRIS.

## 🌟 Fitur Utama

### 👤 Customer Area
- ✅ Browse menu produk Jasuke Mozarella
- ✅ Keranjang belanja interaktif
- ✅ Checkout dengan berbagai metode pembayaran
- ✅ Transfer Bank (BCA, Mandiri, BRI, BNI)
- ✅ **QRIS** - Scan & Pay (bisa upload sendiri)
- ✅ E-Wallet (GoPay, OVO, DANA)
- ✅ Tunai di kasir
- ✅ Riwayat pesanan
- ✅ WhatsApp quick confirmation

### 👨‍💼 Admin Dashboard
- ✅ Dashboard dengan statistik lengkap
- ✅ Manajemen Produk (CRUD + Upload Gambar)
- ✅ Manajemen Pesanan & Update Status
- ✅ **Upload QRIS** sendiri via admin panel
- ✅ Laporan Penjualan 30 hari
- ✅ Monitor stok & produk terlaris
- ✅ Real-time revenue tracking

## 💰 Sistem Pembayaran

### 100% GRATIS - Tanpa Fee!
- **Transfer Bank Manual** - Semua bank populer
- **QRIS** - Upload QR Code dari bank Anda (fee 0.3-0.7%)
- **E-Wallet Manual** - GoPay, OVO, DANA
- **Tunai** - Bayar di kasir

### Opsional: Payment Gateway
- Midtrans (sudah terintegrasi, bisa diaktifkan)
- Auto-verification
- Fee 0.7-3% per transaksi

## 🚀 Quick Start

### 1. Requirements
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Laravel 11.x

### 2. Installation

```bash
# Clone repository
git clone https://github.com/dieall/aplikasi-Mozu.git
cd aplikasi-Mozu

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate key
php artisan key:generate

# Setup database
# Edit .env dengan database Anda:
# DB_DATABASE=db_mozu
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations & seeders
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Run server
php artisan serve
```

### 3. Default Accounts

**Admin:**
- Email: `admin@mozu.com`
- Password: `password`

**Customer:**
- Email: `customer@mozu.com`
- Password: `password`

### 4. Access Application

- **Website**: http://localhost:8000
- **Admin**: http://localhost:8000/admin/dashboard

## 📁 Struktur Database

- `users` - Data pengguna (admin & customer)
- `products` - Produk Jasuke
- `orders` - Pesanan customer
- `order_items` - Detail item pesanan
- `payments` - Data pembayaran
- `settings` - Konfigurasi (QRIS, dll)

## 🎨 Teknologi

- **Backend**: Laravel 11.x
- **Database**: MySQL
- **Frontend**: Blade Templates + TailwindCSS
- **Icons**: Font Awesome 6.4.0
- **Payment**: Midtrans (opsional), Manual Transfer, QRIS

## 📱 Fitur QRIS

1. Login admin dashboard
2. Menu **"Pengaturan"**
3. Upload QR Code QRIS dari bank
4. Customer otomatis lihat QRIS saat checkout!

**Cara dapat QRIS**: Hubungi bank Anda (BCA, Mandiri, BRI, BNI) - **GRATIS!**

## 📚 Dokumentasi

### File Dokumentasi Lengkap:
- `MULAI_DISINI.md` - Panduan Quick Start ⭐
- `INSTALASI.md` - Panduan Instalasi Detail
- `PANDUAN_UPLOAD_QRIS.md` - Cara upload & dapat QRIS
- `PANDUAN_PEMBAYARAN_MANUAL.md` - Alur pembayaran manual
- `INFO_PENTING_PEMBAYARAN.txt` - Checklist setup
- `PANDUAN_MIDTRANS.md` - Integrasi Midtrans (opsional)
- `AKUN_DEFAULT.txt` - Daftar akun & password

## ⚠️ Setup Pembayaran

### Edit Nomor Rekening (WAJIB!)

File: `resources/views/order-success.blade.php`

Ganti nomor dummy dengan nomor ASLI:
- BCA: 8234567890 → [nomor Anda]
- Mandiri: 1320012345678 → [nomor Anda]
- BRI: 012301234567890 → [nomor Anda]
- BNI: 1234567890123 → [nomor Anda]
- E-wallet: 081234567890 → [nomor Anda]
- WhatsApp: 6281234567890 → [nomor Anda]

Baca: `INFO_PENTING_PEMBAYARAN.txt`

## 🎯 Cara Konfirmasi Pembayaran

1. Customer transfer & kirim bukti via WhatsApp
2. Admin cek mutasi rekening
3. Login admin → Menu Pesanan
4. Update status → "Paid"
5. Balas WhatsApp → Konfirmasi
6. Proses pesanan

## 🔐 Keamanan

- Password hashing dengan bcrypt
- CSRF protection
- Authentication middleware
- Admin-only middleware
- Input validation
- SQL injection protection

## 📞 Support

Untuk bantuan atau pertanyaan:
- 📖 Baca dokumentasi lengkap di folder project
- 📧 Contact: [Email support Anda]
- 💬 WhatsApp: [Nomor WA Anda]

## 👥 Tim Pengembang

Dikembangkan oleh:
- **Aldi** (152022253)
- **Khayla Giri Fitriani** (152022078)
- **Fadhilah Nurrahmayanti** (152021018)
- **Hilmy Raihan** (152022228)

**Institut Teknologi Nasional Bandung**  
Program Studi Informatika - 2025

## 📄 License

Aplikasi ini dibuat untuk keperluan tugas kewirausahaan.

## 🙏 Acknowledgments

- Laravel Framework
- Midtrans Payment Gateway
- TailwindCSS
- Font Awesome

---

**© 2025 MOZU - Jasuke Mozarella. All rights reserved.**

**Made with ❤️ for Jasuke Mozarella Business**
