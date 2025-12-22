# 🔐 PANDUAN LENGKAP INTEGRASI MIDTRANS

## ✅ Status Integrasi

Aplikasi MOZU sudah **100% terintegrasi** dengan Midtrans Payment Gateway!

---

## 📋 LANGKAH 1: DAFTAR AKUN MIDTRANS (GRATIS)

### Registrasi

1. Buka: **https://dashboard.midtrans.com/register**
2. Isi form registrasi:
   - Email
   - Password
   - Nama Bisnis: **MOZU - Jasuke Mozarella**
   - Tipe Bisnis: **Food & Beverage**
   - Nomor HP
3. Klik **"Sign Up"**
4. Cek email untuk verifikasi
5. Klik link verifikasi di email

### Login

1. Buka: **https://dashboard.midtrans.com/login**
2. Login dengan email & password Anda
3. Pilih environment: **SANDBOX** (pojok kanan atas)

⚠️ **PENTING**: Gunakan **SANDBOX** untuk testing (GRATIS)

---

## 📋 LANGKAH 2: DAPATKAN API KEYS

### Di Dashboard Midtrans:

1. Pastikan Anda di mode **SANDBOX** (toggle di pojok kanan atas)
2. Klik menu **Settings** (⚙️)
3. Pilih **Access Keys**
4. Copy 3 kredensial berikut:

   **Server Key** - Format: `SB-Mid-server-xxxxxxxxx`
   **Client Key** - Format: `SB-Mid-client-xxxxxxxxx`
   **Merchant ID** - Format: `Gxxxxxxxxx`

📝 **Catatan**: Keys dengan prefix `SB-` adalah Sandbox (testing)

---

## 📋 LANGKAH 3: KONFIGURASI DI APLIKASI

### Edit File .env

1. Buka file: `C:\laragon\www\Aplikasi MOZU\mozu\.env`
2. Cari bagian **Midtrans Configuration** (sudah ada di bawah)
3. Isi dengan API Keys Anda:

```env
# Midtrans Configuration
MIDTRANS_MERCHANT_ID=G812345678
MIDTRANS_CLIENT_KEY=SB-Mid-client-abc123xyz
MIDTRANS_SERVER_KEY=SB-Mid-server-abc123xyz456
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

**Ganti dengan Keys Anda!**

### Restart Server

Setelah mengisi .env, **WAJIB restart server**:

```bash
# Stop server (Ctrl+C)
cd "C:\laragon\www\Aplikasi MOZU\mozu"
php artisan serve
```

---

## 📋 LANGKAH 4: SETUP NOTIFICATION URL

### Di Dashboard Midtrans:

1. Klik menu **Settings** → **Configuration**
2. Isi **Notification URL**:
   ```
   http://localhost:8000/payment/notification
   ```
3. Isi **Finish Redirect URL**:
   ```
   http://localhost:8000/payment/finish
   ```
4. Isi **Unfinish Redirect URL**:
   ```
   http://localhost:8000/payment/unfinish
   ```
5. Isi **Error Redirect URL**:
   ```
   http://localhost:8000/payment/error
   ```
6. Klik **Save**

⚠️ **Catatan**: Untuk production, ganti `localhost:8000` dengan domain Anda

---

## 🎮 TESTING PEMBAYARAN

### Alur Testing Customer:

1. **Buka aplikasi**: http://localhost:8000
2. **Login atau guest checkout**
3. **Tambah produk ke keranjang**
4. **Checkout**
5. **Pilih metode pembayaran**: **Midtrans Payment Gateway**
6. **Klik "Buat Pesanan"**
7. **Klik "Bayar Sekarang"**
8. **Popup Midtrans akan muncul** 🎉

### Metode Pembayaran Test (GRATIS):

#### 1. **Credit Card Test**
```
Nomor Kartu: 4811 1111 1111 1114
CVV: 123
Exp Date: 01/25
OTP/3DS: 112233
```

Hasil: **Pembayaran Sukses** ✅

#### 2. **Credit Card Test (Gagal)**
```
Nomor Kartu: 4911 1111 1111 1113
CVV: 123
Exp Date: 01/25
```

Hasil: **Pembayaran Ditolak** ❌

#### 3. **GoPay Test**
- Pilih GoPay
- Scan QR code (simulasi)
- Masukkan PIN: **123456**

Hasil: **Pembayaran Sukses** ✅

#### 4. **Bank Transfer Test**
- Pilih Bank (BCA/Mandiri/BNI/BRI)
- Salin nomor VA
- **Otomatis sukses di sandbox** ✅

#### 5. **QRIS Test**
- Pilih QRIS
- Scan QR (simulasi)
- **Otomatis sukses** ✅

---

## 🎯 VERIFIKASI PEMBAYARAN

### Setelah Pembayaran:

1. **Customer**: Redirect ke halaman sukses
2. **Admin**: 
   - Login admin
   - Klik menu **Pesanan**
   - Status pesanan otomatis berubah ke **"Paid"** ✅
   - Status pembayaran: **"Paid"**

### Cek di Dashboard Midtrans:

1. Login ke Dashboard Midtrans
2. Klik menu **Transactions**
3. Lihat transaksi terbaru
4. Status: **Settlement** ✅

---

## 📊 STATUS PEMBAYARAN

### Status Order:
- **Pending** → Menunggu pembayaran
- **Paid** → Sudah dibayar (otomatis dari Midtrans)
- **Processing** → Sedang diproses
- **Completed** → Selesai
- **Cancelled** → Dibatalkan

### Status Payment:
- **Pending** → Belum dibayar
- **Paid** → Sudah dibayar (otomatis dari Midtrans)
- **Failed** → Gagal/Expired

---

## 🔔 NOTIFIKASI CALLBACK

### Otomatis dari Midtrans:

Midtrans akan mengirim notifikasi ke:
```
POST http://localhost:8000/payment/notification
```

Aplikasi akan otomatis:
- ✅ Update status order
- ✅ Update status payment
- ✅ Set waktu pembayaran

---

## 🎨 FITUR YANG TERSEDIA

### Payment Methods:
- ✅ Credit Card (Visa, Mastercard, JCB, Amex)
- ✅ Bank Transfer (BCA, Mandiri, BNI, BRI, Permata)
- ✅ E-Wallet (GoPay, ShopeePay)
- ✅ QRIS
- ✅ Convenience Store (Indomaret, Alfamart)
- ✅ Akulaku (Cicilan)

### Security:
- ✅ 3D Secure
- ✅ Fraud Detection
- ✅ Encrypted Transaction
- ✅ PCI DSS Compliant

---

## 🚀 PRODUCTION SETUP

### Saat Deploy ke Production:

1. **Daftar Production Account** di Midtrans
2. **Submit KYC** (verifikasi bisnis)
3. **Ganti di .env**:
   ```env
   MIDTRANS_IS_PRODUCTION=true
   MIDTRANS_CLIENT_KEY=Mid-client-xxxxxxx (tanpa SB-)
   MIDTRANS_SERVER_KEY=Mid-server-xxxxxxx (tanpa SB-)
   ```
4. **Update Notification URL** dengan domain production

⚠️ **Production memerlukan**:
- Verifikasi bisnis (NPWP/NIB)
- Domain resmi (tidak bisa localhost)
- SSL Certificate (HTTPS)

---

## 💰 BIAYA MIDTRANS

### Sandbox (Testing):
- **100% GRATIS**
- Unlimited transaksi
- Semua fitur tersedia

### Production:
- **MDR (Merchant Discount Rate)**:
  - Credit Card: 2.9% per transaksi
  - Bank Transfer: Rp 4.000 per transaksi
  - E-Wallet: 2% per transaksi
  - QRIS: 0.7% per transaksi

📝 Biaya bisa nego tergantung volume transaksi

---

## 🛠️ TROUBLESHOOTING

### Popup Midtrans Tidak Muncul

**Solusi**:
1. Cek Console Browser (F12)
2. Pastikan Client Key sudah benar di .env
3. Restart server Laravel
4. Clear cache browser

### Notifikasi Tidak Diterima

**Solusi**:
1. Cek Server Key di .env
2. Pastikan route `/payment/notification` tidak ter-block
3. Cek Laravel log: `storage/logs/laravel.log`

### Status Tidak Update Otomatis

**Solusi**:
1. Cek Notification URL di Dashboard Midtrans
2. Test notification manual di Dashboard
3. Pastikan Server Key benar

### Error 401 Unauthorized

**Solusi**:
- Server Key salah atau expired
- Pastikan gunakan Sandbox key untuk testing

---

## 📱 TESTING CHECKLIST

- [ ] Daftar akun Midtrans Sandbox
- [ ] Dapatkan API Keys
- [ ] Isi .env dengan keys
- [ ] Restart server
- [ ] Setup Notification URL
- [ ] Test checkout dengan Midtrans
- [ ] Test Credit Card (sukses)
- [ ] Test Credit Card (gagal)
- [ ] Test GoPay
- [ ] Test Bank Transfer
- [ ] Test QRIS
- [ ] Verifikasi status berubah otomatis
- [ ] Cek transaksi di Dashboard Midtrans
- [ ] Cek laporan admin

---

## 📞 SUPPORT

### Jika Ada Masalah:

1. **Dokumentasi**: https://docs.midtrans.com
2. **Dashboard**: https://dashboard.sandbox.midtrans.com
3. **Support Midtrans**: support@midtrans.com
4. **Slack Community**: midtrans-community.slack.com

### Laravel Log:
```
storage/logs/laravel.log
```

### Browser Console:
```
F12 → Console Tab
```

---

## 🎉 SELESAI!

Aplikasi MOZU sudah terintegrasi penuh dengan Midtrans!

**Link Testing**:
- 🌐 Customer: http://localhost:8000
- 💳 Checkout: http://localhost:8000/order/checkout
- 👨‍💼 Admin: http://localhost:8000/admin/dashboard

**Akun Admin**:
- Email: admin@mozu.com
- Password: password

---

**© 2025 MOZU - Jasuke Mozarella | Powered by Midtrans**

