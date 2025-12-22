# 📱 PANDUAN UPLOAD QRIS - MOZU

## ✅ FITUR BARU: Upload QRIS!

Sekarang Anda bisa upload QR Code QRIS sendiri, dan customer akan melihatnya saat checkout!

---

## 🎯 APA ITU QRIS?

**QRIS** (Quick Response Code Indonesian Standard) adalah sistem pembayaran universal di Indonesia.

### Keuntungan QRIS:
✅ **1 QR Code untuk semua** bank & e-wallet
✅ **Gratis** dari bank (tidak ada biaya merchant)
✅ **Mudah** - customer tinggal scan
✅ **Cepat** - pembayaran instant
✅ **Universal** - bisa dari bank/e-wallet manapun

### Yang Bisa Bayar dengan QRIS:
- 🏦 Semua Bank (BCA, Mandiri, BRI, BNI, dll)
- 📱 Semua E-wallet (GoPay, OVO, DANA, ShopeePay, dll)
- 💳 LinkAja, Jenius, dll

---

## 📋 CARA MENDAPATKAN QRIS

### Opsi 1: Via Bank Anda (Recommended)

#### **BCA:**
1. Download **BCA mobile** atau kunjungi cabang
2. Minta aktivasi **QRIS Merchant**
3. Isi formulir (nama usaha, nomor HP, dll)
4. Terima email/SMS berisi QR Code
5. Download/screenshot QR Code

#### **Mandiri:**
1. Download **Livin' by Mandiri**
2. Menu → QRIS → Daftar Merchant
3. Isi data usaha
4. Terima QR Code via email
5. Download QR Code

#### **BRI:**
1. Kunjungi **cabang BRI** terdekat
2. Minta aktivasi **QRIS BRI**
3. Bawa: KTP, NPWP (jika ada)
4. Terima **sticker QRIS** atau file digital
5. Screenshot/foto QR Code

#### **BNI:**
1. Download **BNI Mobile Banking**
2. Menu → QRIS → Merchant Registration
3. Upload dokumen (KTP, foto usaha)
4. Terima approval (1-3 hari kerja)
5. Download QR Code dari app

### Opsi 2: Via Fintech/Payment Aggregator

#### **GoPay for Business:**
1. Daftar: https://www.gojek.com/gopay/business/
2. Isi form merchant
3. Verifikasi (1-2 hari)
4. Dapatkan QRIS dari dashboard
5. Download QR Code

#### **OVO for Business:**
1. Daftar via website OVO Business
2. Submit dokumen usaha
3. Approval 1-3 hari kerja
4. Akses dashboard & download QRIS

#### **DANA Business:**
1. Hubungi DANA Business team
2. Registrasi merchant
3. Dapatkan QRIS

---

## 🎨 CARA UPLOAD QRIS DI APLIKASI

### Langkah-langkah:

1. **Login Admin**
   ```
   http://localhost:8000/admin/dashboard
   Email: admin@mozu.com
   Password: password
   ```

2. **Klik Menu "Pengaturan"**
   - Ada di sidebar kiri
   - Icon ⚙️

3. **Upload QRIS**
   - Klik "Choose File"
   - Pilih file QR Code QRIS Anda
   - Klik "Upload QRIS"

4. **Selesai!** ✅
   - QRIS akan tampil ke customer
   - Preview muncul di halaman settings

---

## 📸 FORMAT FILE QRIS

### Yang Diterima:
- ✅ **Format**: JPG, JPEG, PNG
- ✅ **Ukuran**: Maksimal 2MB
- ✅ **Dimensi**: Bebas, tapi rekomendasi persegi (500x500px atau 1000x1000px)

### Tips Kualitas:
- ✅ Pastikan QR Code **jelas & tajam**
- ✅ Tidak blur atau pixelated
- ✅ Background putih/terang
- ✅ Kontras tinggi (hitam-putih)
- ✅ Tidak ada watermark yang menutupi QR

### Cara Dapat File Berkualitas:
1. **Dari Bank**: Download file original (biasanya PNG HD)
2. **Screenshot Sticker**: Foto dengan kamera HP (cahaya terang)
3. **Edit**: Crop hanya bagian QR Code
4. **Compress**: Jika terlalu besar, compress di tinypng.com

---

## 👀 CARA CUSTOMER MELIHAT QRIS

### Alur Customer:

1. **Checkout** di website MOZU
2. **Pilih metode**: "Transfer Bank / QRIS"
3. **Order Success** → Lihat halaman sukses
4. **Scroll down** → Ada section "QRIS"
5. **Scan QR Code** → Langsung dari HP
6. **Bayar** → Selesai!

---

## 🎯 VERIFIKASI PEMBAYARAN QRIS

### Cara Terima Pembayaran:

1. **Customer scan QRIS** → Bayar
2. **Uang masuk** ke rekening merchant Anda (instant)
3. **Cek mutasi** di m-banking
4. **Customer kirim bukti** via WhatsApp
5. **Admin update status** di dashboard
6. **Konfirmasi** ke customer → Pesanan diproses

### Cara Cek Mutasi QRIS:

**Di Mobile Banking:**
- Login → Mutasi Rekening
- Filter: Hari ini
- Cari: Transaksi masuk via QRIS
- Cek nominal & nama pengirim

**Tips:**
- Set notifikasi SMS/push untuk transaksi masuk
- Nominal QRIS biasanya sudah otomatis potongan (jika ada fee)
- Cek kesesuaian nominal dengan pesanan customer

---

## 💡 TIPS & BEST PRACTICE

### Untuk Admin:

1. **Simpan Backup QRIS**
   - Save file QR Code di folder aman
   - Jika perlu re-upload

2. **Print QRIS Sticker**
   - Print ukuran A5/A4
   - Tempel di kasir
   - Customer bisa scan langsung di toko

3. **Test QRIS Berkala**
   - Scan sendiri untuk test
   - Pastikan masih aktif
   - Jika error, hubungi bank

### Untuk Customer Experience:

1. **Instruksi Jelas**
   - Di website sudah ada instruksi
   - Bisa tambahkan catatan di WA

2. **Responsive**
   - Cek mutasi tiap 30 menit
   - Fast response = happy customer

3. **Konfirmasi Cepat**
   - Update status max 15 menit
   - Balas WA customer

---

## ❓ FAQ

**Q: Apakah QRIS bayar bulanan?**
A: **TIDAK!** QRIS dari bank biasanya GRATIS. Tidak ada biaya setup, tidak ada biaya bulanan.

**Q: Apakah ada fee per transaksi?**
A: Tergantung bank. Beberapa bank:
- **Gratis** untuk transaksi tertentu
- **0.3-0.7%** untuk bisnis kecil
- Bisa nego dengan bank Anda

**Q: Berapa lama approval QRIS?**
A: 
- **Instant** (beberapa bank)
- **1-3 hari kerja** (kebanyakan bank)
- **1 minggu** (jika perlu verifikasi dokumen)

**Q: Harus punya NPWP?**
A: Tidak wajib untuk usaha kecil. Tapi lebih baik punya untuk:
- Limit transaksi lebih tinggi
- Proses approval lebih cepat

**Q: Bisa ganti QRIS?**
A: Bisa! Upload QRIS baru di menu Pengaturan, otomatis replace yang lama.

**Q: QRIS bisa kadaluarsa?**
A: Bisa, jika:
- Rekening merchant ditutup
- Merchant status non-aktif (lama tidak dipakai)
- Hubungi bank untuk reaktivasi

**Q: Customer bayar QRIS, tapi uang tidak masuk?**
A: Jarang terjadi. Jika terjadi:
- Cek mutasi 2-3 jam kemudian (kadang delay)
- Minta screenshot bukti dari customer
- Hubungi bank untuk trace transaksi

---

## 🚀 ALTERNATIF JIKA BELUM PUNYA QRIS

### Sementara Belum Ada QRIS:

**Jangan upload apapun**, sistem akan otomatis:
- Tidak menampilkan section QRIS
- Hanya tampilkan nomor rekening & e-wallet
- Customer bisa transfer manual

**Fokus ke:**
- Transfer Bank (BCA, Mandiri, BRI, BNI)
- E-wallet (GoPay, OVO, DANA)
- Tunai di kasir

**Nanti jika sudah punya QRIS:**
- Langsung upload
- Otomatis muncul ke customer
- Lebih mudah untuk customer

---

## 📞 BANTUAN

### Aktivasi QRIS:

**BCA**: 1500888
**Mandiri**: 14000
**BRI**: 14017 / 1500017
**BNI**: 1500046

### Atau kunjungi cabang terdekat!

---

## ✅ CHECKLIST

- [ ] Hubungi bank untuk aktivasi QRIS
- [ ] Dapatkan file/sticker QR Code
- [ ] Screenshot/download QR Code (format PNG/JPG)
- [ ] Login admin dashboard
- [ ] Klik menu "Pengaturan"
- [ ] Upload QRIS
- [ ] Test: Checkout dan lihat apakah QRIS muncul
- [ ] Test scan QRIS dengan HP Anda
- [ ] Set notifikasi mutasi rekening
- [ ] Siap terima pembayaran QRIS! 🎉

---

## 🎉 KESIMPULAN

**QRIS = Solusi Pembayaran Modern & Gratis!**

**Keuntungan:**
- ✅ 1 QR untuk semua payment method
- ✅ Gratis atau fee sangat murah (< 1%)
- ✅ Customer experience lebih baik
- ✅ Instant payment
- ✅ Tidak perlu WhatsApp konfirmasi (uang langsung masuk)

**Setup:**
- Daftar QRIS: 1-7 hari
- Upload di aplikasi: 2 menit
- **Total: 1 minggu sampai siap!**

---

**Selamat menggunakan QRIS! Mudah-mudahan penjualan makin lancar!** 🚀💰

**© 2025 MOZU - Jasuke Mozarella**

