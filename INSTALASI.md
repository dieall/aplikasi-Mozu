# 📖 Panduan Instalasi Aplikasi MOZU

## Langkah-langkah Instalasi Lengkap

### 1. Persiapan Awal

Pastikan Anda sudah menginstall:
- ✅ Laragon (sudah terinstall)
- ✅ PHP 8.2+
- ✅ Composer
- ✅ MySQL/MariaDB

### 2. Lokasi Aplikasi

Aplikasi sudah berada di:
```
C:\laragon\www\Aplikasi MOZU\mozu
```

### 3. Konfigurasi Database

Database sudah dikonfigurasi dengan nama: `db_mozu`

Jika belum ada, buat database dengan cara:

**Via Laragon:**
1. Buka Laragon
2. Klik Menu → MySQL → Open MySQL
3. Jalankan query:
```sql
CREATE DATABASE db_mozu;
```

**Via phpMyAdmin:**
1. Buka http://localhost/phpmyadmin
2. Klik "New" di sidebar
3. Masukkan nama database: `db_mozu`
4. Klik "Create"

### 4. Setup Environment (Sudah Dikonfigurasi)

File `.env` sudah dikonfigurasi dengan:
- Database: `db_mozu`
- Username: `root`
- Password: (kosong)

### 5. Jalankan Migration & Seeder (Sudah Dijalankan)

Jika ingin mengulang dari awal:

```bash
cd "C:\laragon\www\Aplikasi MOZU\mozu"

# Reset database
php artisan migrate:fresh

# Isi data sample
php artisan db:seed

# Link storage
php artisan storage:link
```

### 6. Menjalankan Aplikasi

```bash
cd "C:\laragon\www\Aplikasi MOZU\mozu"
php artisan serve
```

Atau gunakan Laragon:
1. Start Laragon
2. Akses: `http://mozu.test` (jika sudah setup virtual host)
3. Atau: `http://localhost:8000`

### 7. Login ke Aplikasi

**Admin Dashboard:**
- URL: http://localhost:8000/admin/dashboard
- Email: `admin@mozu.com`
- Password: `password`

**Customer:**
- URL: http://localhost:8000
- Email: `customer@mozu.com`
- Password: `password`

## 🎯 Alur Penggunaan

### Sebagai Customer:

1. **Browse Produk**
   - Buka homepage
   - Lihat daftar produk yang tersedia

2. **Tambah ke Keranjang**
   - Klik "Tambah ke Keranjang" pada produk
   - Lihat jumlah item di icon cart (navbar)

3. **Checkout**
   - Klik icon cart di navbar
   - Review pesanan
   - Klik "Checkout"
   - Isi data pelanggan
   - Pilih metode pengambilan (Take Away/Dine In)
   - Pilih metode pembayaran
   - Klik "Buat Pesanan"

4. **Lihat Riwayat**
   - Login terlebih dahulu
   - Klik "Pesanan Saya" di navbar

### Sebagai Admin:

1. **Dashboard**
   - Lihat statistik penjualan
   - Monitor pesanan terbaru
   - Cek produk terlaris

2. **Kelola Produk**
   - Klik menu "Produk"
   - Tambah/Edit/Hapus produk
   - Upload gambar produk
   - Update stok

3. **Kelola Pesanan**
   - Klik menu "Pesanan"
   - Lihat semua pesanan
   - Klik "Detail" untuk melihat detail pesanan
   - Update status pesanan

4. **Laporan**
   - Klik menu "Laporan"
   - Lihat laporan penjualan 30 hari terakhir
   - Total pesanan dan pendapatan per hari

## 🔧 Troubleshooting

### Database Connection Error

Jika muncul error koneksi database:

1. Pastikan MySQL/MariaDB sudah running di Laragon
2. Cek file `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_mozu
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Pastikan database `db_mozu` sudah dibuat

### Storage Link Error

Jika gambar tidak muncul:

```bash
php artisan storage:link
```

### Permission Denied

Jika ada error permission di Windows:

1. Jalankan Command Prompt/PowerShell sebagai Administrator
2. Atau ubah permission folder `storage` dan `bootstrap/cache`

### Clear Cache

Jika ada error aneh:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Regenerate App Key

Jika APP_KEY belum diset:

```bash
php artisan key:generate
```

## 📱 Testing

### Test Customer Flow:

1. Buka http://localhost:8000
2. Tambah 2-3 produk ke keranjang
3. Checkout dengan data:
   - Nama: Test Customer
   - Phone: 08123456789
   - Metode: Take Away
   - Pembayaran: Cash
4. Cek halaman sukses
5. Login dan cek "Pesanan Saya"

### Test Admin Flow:

1. Login sebagai admin
2. Tambah produk baru
3. Lihat pesanan yang masuk
4. Update status pesanan
5. Cek laporan penjualan

## 🚀 Production Deployment

Untuk deploy ke production:

1. Set `APP_ENV=production` di `.env`
2. Set `APP_DEBUG=false`
3. Optimize:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Setup proper web server (Apache/Nginx)
5. Enable HTTPS
6. Setup backup database regular

## 📞 Bantuan

Jika ada masalah, cek:
1. Laravel Log: `storage/logs/laravel.log`
2. Web Server Error Log
3. Browser Console (F12)

---

**Selamat menggunakan MOZU! 🎉**

