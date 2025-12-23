# PRESENTASI SISTEM APLIKASI MOZU
## Jasuke Mozarella - Sistem Pemesanan Digital

---

## SLIDE 1: COVER
### 🌽 APLIKASI MOZU
**Sistem Pemesanan Digital Jasuke Mozarella**

**Tagline:** "Bantu UMKM Beralih ke Sistem Digital"

**Disusun oleh:** Tim Pengembang MOZU  
**Tahun:** 2025

---

## SLIDE 2: LATAR BELAKANG

### 📊 Permasalahan UMKM Tradisional

**Tantangan yang Dihadapi:**
- ❌ Pencatatan manual yang rawan error
- ❌ Antrian panjang saat jam sibuk
- ❌ Sulit tracking stok produk
- ❌ Laporan penjualan tidak terstruktur
- ❌ Pembayaran terbatas (hanya cash)
- ❌ Susah monitoring performa bisnis

**Dampak:**
- Kehilangan pelanggan karena antrian
- Kesalahan perhitungan & pencatatan
- Tidak ada data untuk analisis bisnis

---

## SLIDE 3: SOLUSI & TUJUAN

### 🎯 Solusi: Aplikasi MOZU

**Sistem Pemesanan Digital Terintegrasi**

**Tujuan Utama:**
1. ✅ Digitalisasi proses pemesanan
2. ✅ Otomasi pencatatan & laporan
3. ✅ Manajemen stok real-time
4. ✅ Multi metode pembayaran
5. ✅ Meningkatkan efisiensi operasional
6. ✅ Memberikan data untuk pengambilan keputusan

**Target Pengguna:**
- Customer: Pembeli Jasuke Mozarella
- Admin: Pemilik & operator UMKM

---

## SLIDE 4: ARSITEKTUR SISTEM

### 🏗️ Teknologi & Arsitektur

```
┌─────────────────────────────────────────┐
│         APLIKASI WEB MOZU               │
├─────────────────────────────────────────┤
│  Frontend: Blade + Tailwind CSS         │
├─────────────────────────────────────────┤
│  Backend: Laravel 11.x (PHP 8.2+)       │
├─────────────────────────────────────────┤
│  Database: MySQL (db_mozu)              │
├─────────────────────────────────────────┤
│  Storage: Local File System             │
└─────────────────────────────────────────┘
```

**Komponen Utama:**
- **MVC Pattern** (Model-View-Controller)
- **Authentication System** (Login/Register)
- **Role Management** (Customer & Admin)
- **Session Management** (Shopping Cart)
- **File Upload** (Product Images & QRIS)
- **Reporting System** (Dashboard & Analytics)

---

## SLIDE 5: FITUR UTAMA - CUSTOMER

### 👥 Panel Customer

**1. Beranda & Katalog Produk**
   - Lihat semua menu Jasuke Mozarella
   - Filter produk yang tersedia
   - Info stok real-time

**2. Shopping Cart**
   - Tambah/Update/Hapus item
   - Kalkulasi otomatis
   - Lihat total pesanan

**3. Checkout & Pembayaran**
   - Form data customer
   - Pilih metode: Takeaway/Dine-in
   - Multi payment: Cash, Transfer, E-wallet, QRIS

**4. Konfirmasi Pesanan**
   - Nomor pesanan unik
   - Detail pembayaran
   - QR Code QRIS
   - WhatsApp confirmation button

**5. Riwayat Pesanan**
   - Tracking status pesanan
   - Download/Print receipt

---

## SLIDE 6: FITUR UTAMA - ADMIN

### 👨‍💼 Panel Admin

**1. Dashboard**
   - Total Revenue & Today's Revenue
   - Total Orders & Pending Orders
   - Grafik penjualan 30 hari
   - Best selling products

**2. Manajemen Produk**
   - CRUD Produk (Create, Read, Update, Delete)
   - Upload gambar produk
   - Set harga & stok
   - Toggle ketersediaan

**3. Manajemen Pesanan**
   - Lihat semua pesanan
   - Filter by status
   - Update status pesanan
   - Detail order items

**4. Laporan Penjualan**
   - Laporan harian
   - Total penjualan per produk
   - Export data

**5. Pengaturan**
   - Upload QRIS untuk pembayaran
   - Konfigurasi aplikasi

---

## SLIDE 7: ALUR SISTEM (FLOW)

### 🔄 Flow Diagram

**A. CUSTOMER FLOW:**
```
1. Register/Login
   ↓
2. Browse Products
   ↓
3. Add to Cart
   ↓
4. Checkout (Isi Data)
   ↓
5. Pilih Payment Method
   ↓
6. Konfirmasi Pesanan
   ↓
7. Transfer/Bayar
   ↓
8. Konfirmasi via WhatsApp
   ↓
9. Tracking Status
   ↓
10. Pesanan Selesai
```

**B. ADMIN FLOW:**
```
1. Login Admin
   ↓
2. Cek Pesanan Baru
   ↓
3. Verifikasi Pembayaran
   ↓
4. Update Status → Processing
   ↓
5. Siapkan Pesanan
   ↓
6. Update Status → Completed
   ↓
7. View Dashboard & Reports
```

---

## SLIDE 8: DATABASE SCHEMA

### 🗄️ Struktur Database

**Tabel Utama:**

1. **users**
   - id, name, email, password, role
   - Menyimpan data customer & admin

2. **products**
   - id, name, description, price, stock, image, is_available
   - Katalog menu Jasuke

3. **orders**
   - id, order_number, user_id, customer_name, customer_phone
   - notes, pickup_method, total_amount, status
   - Master data pesanan

4. **order_items**
   - id, order_id, product_id, quantity, price, subtotal
   - Detail item dalam pesanan

5. **payments**
   - id, order_id, payment_method, amount, status, paid_at
   - Data transaksi pembayaran

6. **settings**
   - id, qris_image
   - Konfigurasi aplikasi (QRIS)

---

## SLIDE 9: KEUNGGULAN APLIKASI

### ⭐ 8 Keunggulan Utama

1. **🚀 Pemesanan Cepat & Terintegrasi**
   - Sistem digital yang mudah digunakan
   - Tidak perlu antri panjang

2. **🛡️ Pembayaran Digital Aman**
   - Multi metode: Cash, Transfer, E-wallet, QRIS
   - Konfirmasi via WhatsApp

3. **📈 Laporan Otomatis**
   - Pencatatan transaksi otomatis
   - Dashboard statistik real-time

4. **📱 QRIS Ready**
   - Upload QR Code sendiri
   - Support semua bank & e-wallet

5. **📊 Dashboard Real-Time**
   - Monitor penjualan live
   - Grafik & analytics

6. **📦 Manajemen Stok Otomatis**
   - Stok update otomatis saat order
   - Alert stok menipis

7. **💬 WhatsApp Integration**
   - Quick confirmation button
   - Auto-fill message dengan order number

8. **📱 100% Responsive**
   - Sempurna di HP, Tablet, PC
   - Mobile-first design

---

## SLIDE 10: PENUTUP & DEMO

### 🎉 Kesimpulan

**Manfaat untuk UMKM:**
- ✅ Efisiensi operasional meningkat
- ✅ Pengalaman customer lebih baik
- ✅ Data terstruktur untuk analisis
- ✅ Siap berkembang ke digital
- ✅ Biaya operasional lebih rendah

**Teknologi:**
- ✅ Laravel 11 (Framework Modern)
- ✅ MySQL Database
- ✅ Tailwind CSS (Responsive Design)
- ✅ 100% Open Source

**Status Proyek:**
- ✅ Fully Functional
- ✅ Production Ready
- ✅ Terintegrasi dengan GitHub
- ✅ Dokumentasi Lengkap

**Demo:** http://localhost:8000

**Repository:** https://github.com/dieall/aplikasi-Mozu.git

---

### 📞 Terima Kasih!

**Contact:**
- WhatsApp: 081234567890
- Email: admin@mozu.com
- Website: mozu.local

**Q&A Session**

