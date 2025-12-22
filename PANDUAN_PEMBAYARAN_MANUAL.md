# 💰 PANDUAN PEMBAYARAN MANUAL - MOZU

## 🎯 SISTEM PEMBAYARAN HYBRID

Aplikasi MOZU menggunakan strategi pembayaran **HYBRID** yang menguntungkan:

### ✅ Fase Awal (Sekarang): 100% GRATIS
- Transfer Bank Manual
- E-wallet Manual  
- Cash (Tunai)
- QRIS Static (dari bank)
- **Biaya: Rp 0,-** (tidak ada fee apapun!)

### 🚀 Fase Growth (Nanti): Payment Gateway Otomatis
- Midtrans/Xendit/Tripay (opsional)
- Auto-verification
- **Biaya: 0.7-3% per transaksi online**

---

## 📋 INFO PEMBAYARAN DI APLIKASI

### Yang Ditampilkan ke Customer:

#### 🏦 **Transfer Bank:**
- **BCA**: 8234567890 a.n. MOZU Jasuke
- **Mandiri**: 1320012345678 a.n. MOZU Jasuke
- **BRI**: 012301234567890 a.n. MOZU Jasuke
- **BNI**: 1234567890123 a.n. MOZU Jasuke
- **QRIS**: (tampil placeholder, bisa kirim via WA)

#### 📱 **E-Wallet:**
- **GoPay**: 081234567890 a.n. MOZU Jasuke
- **OVO**: 081234567890 a.n. MOZU Jasuke
- **DANA**: 081234567890 a.n. MOZU Jasuke

#### 📞 **WhatsApp Konfirmasi:**
- **0812-3456-7890** (tombol langsung chat)

⚠️ **PENTING**: Ganti nomor rekening & WhatsApp di atas dengan milik Anda yang sebenarnya!

---

## 🔧 CARA UPDATE INFO PEMBAYARAN

### Edit Nomor Rekening:

1. **Buka file**: `resources/views/order-success.blade.php`
2. **Cari baris** dengan nomor rekening (misalnya: `8234567890`)
3. **Ganti** dengan nomor rekening Anda
4. **Ganti** nama penerima (misalnya: `MOZU Jasuke`)
5. **Save** file

### Edit Nomor WhatsApp:

1. **Cari baris**: `https://wa.me/6281234567890`
2. **Ganti** dengan nomor WA Anda (format: 62812xxxxx)
3. **Ganti** teks tombol: `0812-3456-7890`

### Contoh Edit:

```php
<!-- BCA -->
<p class="text-lg font-bold text-gray-800">8234567890</p>  <!-- GANTI INI -->
<p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>  <!-- GANTI INI -->
```

Ganti menjadi:
```php
<!-- BCA -->
<p class="text-lg font-bold text-gray-800">1234567890</p>  <!-- Nomor rekening REAL -->
<p class="text-sm text-gray-700 font-semibold mt-1">a.n. Aldi Permana</p>  <!-- Nama REAL -->
```

---

## 📱 ALUR PEMBAYARAN MANUAL

### Customer Side:

1. **Checkout** → Pilih metode (Transfer/E-wallet)
2. **Order Success** → Lihat info rekening lengkap
3. **Transfer** → Customer transfer sesuai nominal
4. **Screenshot** → Customer ambil bukti transfer
5. **WhatsApp** → Kirim bukti via WA (klik tombol)
6. **Tunggu** → Menunggu konfirmasi admin

### Admin Side:

1. **Terima WA** → Customer kirim bukti transfer
2. **Cek Mutasi** → Buka m-banking, cek mutasi rekening
3. **Verifikasi** → Cocokkan nominal dengan pesanan
4. **Login Admin** → Buka dashboard admin
5. **Buka Pesanan** → Menu Pesanan → Cari nomor pesanan
6. **Update Status** → 
   - Ubah status order: **"Paid"** (Dibayar)
   - Otomatis status payment juga berubah
7. **Balas WA** → Konfirmasi ke customer pesanan diproses
8. **Proses** → Siapkan pesanan

---

## 🎯 CARA KONFIRMASI PEMBAYARAN (ADMIN)

### Step-by-Step:

#### 1. **Cek Mutasi Rekening**

**Via M-Banking:**
- Login m-banking (BCA Mobile, Livin, BRImo, dll)
- Menu → Mutasi Rekening
- Cari transaksi masuk sesuai nominal
- Screenshot untuk arsip

**Tips:**
- Bandingkan waktu transfer dengan waktu WA masuk
- Cocokkan nominal PERSIS
- Cek nama pengirim

#### 2. **Login Admin Dashboard**

```
http://localhost:8000/admin/dashboard
Email: admin@mozu.com
Password: password
```

#### 3. **Buka Menu Pesanan**

- Klik **"Pesanan"** di sidebar
- Cari pesanan berdasarkan:
  - Nomor pesanan (dari WA customer)
  - Nama customer
  - Nominal
  - Waktu order

#### 4. **Klik Detail Pesanan**

- Klik tombol **"Detail"** pada pesanan
- Cek detail:
  - Nomor pesanan ✓
  - Total amount ✓
  - Status: Pending
  - Payment: Pending

#### 5. **Update Status**

- Di halaman detail, ada form **"Ubah Status"**
- Pilih: **"Paid"** (Dibayar)
- Klik **"Update Status"**
- Status order → Paid ✅
- Status payment → Paid ✅
- Paid_at → Set otomatis

#### 6. **Konfirmasi ke Customer**

**Via WhatsApp:**
```
Halo Kak [Nama Customer],

Pembayaran untuk pesanan [Nomor Pesanan] sudah diterima ✅

Total: Rp [Nominal]
Status: Pesanan sedang diproses

Pesanan bisa diambil di:
📍 [Alamat Toko]
⏰ [Jam Operasional]

Terima kasih sudah order di MOZU! 😊
```

---

## 💡 TIPS & BEST PRACTICE

### Untuk Efisiensi:

1. **Set Jam Konfirmasi**
   - Pagi: 09:00 - 12:00
   - Siang: 12:00 - 15:00
   - Sore: 15:00 - 18:00
   - Info ke customer respon 5-15 menit

2. **Template Pesan WA**
   - Buat template untuk:
     - Konfirmasi pembayaran diterima
     - Pesanan diproses
     - Pesanan siap diambil
     - Ucapan terima kasih

3. **Cek Mutasi Berkala**
   - Setiap 1-2 jam
   - Atau setiap ada notif WA masuk
   - Set reminder di HP

4. **Arsip Bukti Transfer**
   - Screenshot semua bukti transfer
   - Simpan di folder terorganisir
   - Untuk rekonsiliasi bulanan

### Untuk Menghindari Error:

1. **Jangan Update Langsung ke Completed**
   - Paid → Processing → Completed
   - Biar ada tracking yang jelas

2. **Double Check Nominal**
   - Pastikan transfer PERSIS
   - Jika kurang, minta customer transfer sisa
   - Jika lebih, catat untuk dikembalikan

3. **Verifikasi Nama Pengirim**
   - Tanyakan via WA jika beda nama
   - Untuk keamanan

---

## 📊 MONITORING PEMBAYARAN

### Dashboard Admin:

**Menu Pesanan:**
- Filter by status: Pending
- Ini pesanan yang belum bayar
- Follow up via WA jika > 2 jam

**Menu Laporan:**
- Lihat penjualan harian
- Total revenue
- Rekonsiliasi dengan mutasi bank

### Rekonsiliasi Harian:

**Setiap Hari:**
1. Print/export laporan dari admin
2. Print mutasi rekening dari m-banking
3. Cocokkan satu per satu
4. Pastikan tidak ada yang terlewat

---

## 🚀 UPGRADE KE OTOMATIS (OPSIONAL)

### Kapan Perlu Upgrade?

**Pertimbangkan payment gateway otomatis jika:**
- Transaksi > 50 per hari
- Sulit keep up manual verification
- Mau fokus ke produksi, bukan admin
- Profit sudah stabil

### Opsi Payment Gateway:

1. **Midtrans** (sudah terintegrasi!)
   - Baca: `PANDUAN_MIDTRANS.md`
   - Fee: 0.7-3%
   - Setup: 10 menit

2. **Xendit**
   - Fee: 0.7-3%
   - UI modern

3. **Tripay**
   - Fee: 0.5-2.5%
   - Lebih murah

**Keuntungan:**
- ✅ Auto-verify pembayaran
- ✅ Real-time status update
- ✅ Tidak perlu cek mutasi manual
- ✅ Customer experience lebih baik

**Biaya:**
- ❌ Fee per transaksi
- Tapi worth it jika volume tinggi

---

## 📞 FAQ

**Q: Bagaimana jika customer salah transfer?**
A: Minta bukti transfer, cek mutasi, hubungi via WA untuk klarifikasi. Jika memang salah nominal, minta transfer sisa atau refund kelebihan.

**Q: Berapa lama maksimal tunggu pembayaran?**
A: Set deadline 2-6 jam. Jika lewat, follow up WA atau cancel order. Update di notes customer.

**Q: Bagaimana track pesanan yang belum bayar?**
A: Di admin dashboard → Pesanan → Filter status "Pending". Follow up via WA.

**Q: Apakah bisa pakai 1 rekening saja?**
A: Bisa! Tampilkan yang paling sering dipakai. Tapi lebih baik kasih opsi agar customer fleksibel.

**Q: Harus punya semua bank?**
A: Tidak. Edit file order-success.blade.php, hapus bank yang tidak punya. Minimal 1-2 bank populer (BCA/Mandiri) sudah cukup.

---

## 📁 FILE YANG PERLU DIEDIT

```
resources/views/order-success.blade.php
```

**Yang perlu diganti:**
- Nomor rekening (semua bank)
- Nama penerima rekening
- Nomor HP e-wallet
- Nomor WhatsApp konfirmasi

**Cara edit:**
1. Buka file di text editor
2. Ctrl+F cari "8234567890" atau "081234567890"
3. Ganti dengan nomor REAL Anda
4. Save
5. Refresh browser

---

## ✅ CHECKLIST SETUP

- [ ] Edit nomor rekening BCA (jika punya)
- [ ] Edit nomor rekening Mandiri (jika punya)
- [ ] Edit nomor rekening BRI (jika punya)
- [ ] Edit nomor rekening BNI (jika punya)
- [ ] Edit nomor GoPay (jika punya)
- [ ] Edit nomor OVO (jika punya)
- [ ] Edit nomor DANA (jika punya)
- [ ] Edit nomor WhatsApp konfirmasi
- [ ] Ganti nama penerima (semua)
- [ ] Test checkout → cek tampilan
- [ ] Save template pesan WA
- [ ] Setup reminder cek mutasi
- [ ] Print panduan ini untuk referensi

---

## 🎉 KESIMPULAN

**Sistem pembayaran manual = 100% GRATIS!**

**Keuntungan:**
- ✅ Tidak ada fee sama sekali
- ✅ Semua uang masuk ke rekening Anda
- ✅ Fleksibel, customer pilih bank favorit
- ✅ Cocok untuk usaha kecil-menengah

**Kekurangan:**
- ⚠️ Perlu verifikasi manual
- ⚠️ Butuh 5-15 menit per konfirmasi
- ⚠️ Harus rajin cek mutasi

**Solusi:**
- Set jam tertentu untuk cek mutasi
- Gunakan template pesan WA
- Upgrade ke payment gateway jika volume tinggi

---

**Semoga sukses dengan MOZU! 🚀**

**© 2025 MOZU - Jasuke Mozarella**

