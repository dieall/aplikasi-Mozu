@extends('layouts.admin')

@section('title', 'Pengaturan - MOZU')
@section('page-title', 'Pengaturan')

@section('content')
<div class="max-w-4xl">
    <!-- QRIS Settings -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-qrcode text-purple-600 mr-2"></i>
            Upload QRIS
        </h2>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                <div class="text-sm text-gray-700">
                    <p class="font-semibold mb-1">Tentang QRIS</p>
                    <p>Upload gambar QR Code QRIS Anda di sini. Customer akan melihat QR Code ini saat melakukan pembayaran dengan metode Transfer Bank.</p>
                    <p class="mt-2"><strong>Cara mendapatkan QRIS:</strong></p>
                    <ol class="list-decimal ml-5 mt-1">
                        <li>Hubungi bank Anda (BCA, Mandiri, BRI, BNI, dll)</li>
                        <li>Minta aktivasi QRIS (biasanya gratis)</li>
                        <li>Download/screenshot QR Code QRIS</li>
                        <li>Upload di sini</li>
                    </ol>
                </div>
            </div>
        </div>

        @if($qrisImage)
        <!-- Current QRIS -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-2">QRIS Saat Ini:</h3>
            <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4 text-center">
                <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS Code" class="max-w-xs mx-auto rounded">
                <p class="text-sm text-gray-600 mt-3">
                    <i class="fas fa-check-circle text-green-500"></i> 
                    QRIS aktif dan akan ditampilkan ke customer
                </p>
            </div>
            
            <form action="{{ route('admin.settings.qris.delete') }}" method="POST" class="mt-3" onsubmit="return confirm('Yakin ingin menghapus QRIS?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-700 text-sm">
                    <i class="fas fa-trash"></i> Hapus QRIS
                </button>
            </form>
        </div>
        @endif

        <!-- Upload Form -->
        <form action="{{ route('admin.settings.qris.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="qris_image" class="block text-gray-700 font-semibold mb-2">
                    {{ $qrisImage ? 'Ganti QRIS:' : 'Upload QRIS:' }}
                </label>
                <input type="file" id="qris_image" name="qris_image" accept="image/*" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('qris_image') border-red-500 @enderror">
                @error('qris_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-600 mt-1">
                    Format: JPG, PNG | Maksimal: 2MB | Rekomendasi: Ukuran persegi (500x500px)
                </p>
            </div>
            
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                <i class="fas fa-upload"></i> {{ $qrisImage ? 'Update QRIS' : 'Upload QRIS' }}
            </button>
        </form>
    </div>

    <!-- Payment Info Settings -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-university text-blue-600 mr-2"></i>
            Info Pembayaran
        </h2>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3 mt-1"></i>
                <div class="text-sm text-gray-700">
                    <p class="font-semibold mb-1">Edit Nomor Rekening & E-Wallet</p>
                    <p>Untuk mengubah nomor rekening bank (BCA, Mandiri, BRI, BNI) dan nomor e-wallet (GoPay, OVO, DANA), edit file:</p>
                    <code class="block bg-gray-800 text-green-400 p-2 rounded mt-2 text-xs">
                        resources/views/order-success.blade.php
                    </code>
                    <p class="mt-2">Panduan lengkap: <strong>INFO_PENTING_PEMBAYARAN.txt</strong></p>
                    <p class="mt-1">Atau: <strong>PANDUAN_PEMBAYARAN_MANUAL.md</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

