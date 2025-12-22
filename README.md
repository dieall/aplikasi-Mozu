# MOZU - Aplikasi Jasuke Mozarella

Aplikasi pemesanan digital untuk usaha Jasuke Mozarella dengan sistem manajemen lengkap.

## 🌟 Fitur Utama

### Untuk Customer:
- ✅ Browse menu produk Jasuke Mozarella
- ✅ Keranjang belanja
- ✅ Checkout dengan berbagai metode pembayaran (Cash, Transfer, E-wallet)
- ✅ Pilihan Take Away atau Dine In
- ✅ Riwayat pesanan (untuk user yang login)
- ✅ Registrasi dan Login

### Untuk Admin:
- ✅ Dashboard dengan statistik penjualan
- ✅ Manajemen produk (CRUD)
- ✅ Manajemen pesanan dengan update status
- ✅ Laporan penjualan harian
- ✅ Monitoring stok produk

## 🛠️ Teknologi

- **Framework**: Laravel 11.x
- **Database**: MySQL
- **Frontend**: Blade Templates + Tailwind CSS
- **Icons**: Font Awesome

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM (optional)

## 🚀 Instalasi

Aplikasi sudah siap digunakan! Database sudah dikonfigurasi dan data sample sudah diisi.

### Akun Default:

**Admin:**
- Email: `admin@mozu.com`
- Password: `password`

**Customer:**
- Email: `customer@mozu.com`
- Password: `password`

## 🎯 Cara Menggunakan

### 1. Jalankan Server Development

```bash
cd "C:\laragon\www\Aplikasi MOZU\mozu"
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

### 2. Akses Admin Dashboard

1. Login dengan akun admin
2. Akan otomatis redirect ke: `http://localhost:8000/admin/dashboard`
3. Menu yang tersedia:
   - Dashboard: Statistik dan overview
   - Produk: Kelola menu produk
   - Pesanan: Kelola dan update status pesanan
   - Laporan: Laporan penjualan harian

### 3. Customer Flow

1. Kunjungi homepage untuk browse produk
2. Klik "Tambah ke Keranjang" untuk menambah produk
3. Lihat keranjang dengan klik icon cart di navbar
4. Klik "Checkout" untuk melanjutkan pemesanan
5. Isi data pelanggan, pilih metode pengambilan dan pembayaran
6. Klik "Buat Pesanan"
7. Pesanan berhasil dibuat dan akan muncul di halaman sukses

## 📁 Struktur Database

### Tabel Utama:

1. **users** - Data pengguna (admin & customer)
2. **products** - Data produk Jasuke
3. **orders** - Data pesanan
4. **order_items** - Detail item dalam pesanan
5. **payments** - Data pembayaran

## 🎨 Fitur Unggulan

### Manajemen Produk
- Upload gambar produk
- Set status ketersediaan
- Monitor stok otomatis berkurang saat ada pesanan
- Alert stok menipis

### Sistem Pembayaran
- Multiple payment methods (Cash, Transfer, E-wallet)
- Status pembayaran (Pending, Paid, Failed)
- Tracking pembayaran per order

### Dashboard Admin
- Real-time statistics
- Grafik penjualan
- Top selling products
- Recent orders

## 📝 Catatan Pengembangan

Aplikasi ini dikembangkan berdasarkan proposal kewirausahaan untuk:
- **Usaha**: Jasuke Mozarella
- **Institusi**: Institut Teknologi Nasional Bandung
- **Program Studi**: Informatika
- **Tim Pengembang**:
  - Aldi (152022253)
  - Khayla Giri Fitriani (152022078)
  - Fadhilah Nurrahmayanti (152021018)
  - Hilmy Raihan (152022228)

## 🔒 Keamanan

- Password di-hash menggunakan bcrypt
- CSRF protection aktif
- Middleware auth untuk proteksi route
- Admin middleware untuk proteksi admin area

## 📞 Support

Untuk pertanyaan atau bantuan, silakan hubungi tim pengembang.

---

**© 2025 MOZU - Jasuke Mozarella. All rights reserved.**
