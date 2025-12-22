@extends('layouts.app')

@section('title', 'Pesanan Berhasil - MOZU')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md p-8 text-center">
        <div class="mb-6">
            <i class="fas fa-check-circle text-6xl text-green-500"></i>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h1>
        <p class="text-gray-600 mb-6">Terima kasih telah memesan di MOZU.</p>
        
        <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Nomor Pesanan</p>
                    <p class="font-bold text-lg text-orange-600">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal</p>
                    <p class="font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            
            <div class="border-t pt-4">
                <h3 class="font-bold mb-2">Detail Pesanan:</h3>
                <div class="space-y-2">
                    @foreach($order->orderItems as $item)
                        <div class="flex justify-between text-sm">
                            <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span class="text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Payment Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                <div class="text-left w-full">
                    <p class="font-semibold text-gray-800 mb-1">Informasi Pembayaran</p>
                    <p class="text-sm text-gray-600">
                        Metode: <span class="font-semibold">{{ strtoupper($order->payment->payment_method) }}</span><br>
                        Status: <span class="font-semibold">{{ $order->payment->status === 'paid' ? 'Lunas' : 'Menunggu Pembayaran' }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Payment Instructions for Transfer/E-wallet -->
        @if(in_array($order->payment->payment_method, ['transfer', 'ewallet']) && $order->payment->status === 'pending')
        <div class="bg-gradient-to-r from-orange-50 to-yellow-50 border-2 border-orange-200 rounded-lg p-6 mb-6 text-left">
            <h3 class="text-xl font-bold text-orange-700 mb-4 flex items-center">
                <i class="fas fa-money-bill-wave mr-2"></i>
                Cara Pembayaran
            </h3>
            
            @if($order->payment->payment_method === 'transfer')
            <!-- Bank Transfer -->
            <div class="space-y-4">
                <p class="text-sm text-gray-700 font-semibold">Silakan transfer ke salah satu rekening berikut:</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- BCA -->
                    <div class="bg-white border-2 border-blue-500 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-blue-500 text-white px-3 py-1 rounded font-bold text-sm">BCA</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor Rekening</p>
                        <p class="text-lg font-bold text-gray-800">8234567890</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                    
                    <!-- Mandiri -->
                    <div class="bg-white border-2 border-yellow-500 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-yellow-500 text-white px-3 py-1 rounded font-bold text-sm">MANDIRI</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor Rekening</p>
                        <p class="text-lg font-bold text-gray-800">1320012345678</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                    
                    <!-- BRI -->
                    <div class="bg-white border-2 border-blue-600 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-blue-600 text-white px-3 py-1 rounded font-bold text-sm">BRI</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor Rekening</p>
                        <p class="text-lg font-bold text-gray-800">012301234567890</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                    
                    <!-- BNI -->
                    <div class="bg-white border-2 border-orange-500 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm">BNI</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor Rekening</p>
                        <p class="text-lg font-bold text-gray-800">1234567890123</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                </div>
                
                <!-- QRIS -->
                @php
                    $qrisImage = \App\Models\Setting::get('qris_image');
                @endphp
                @if($qrisImage)
                <div class="bg-white border-2 border-purple-500 rounded-lg p-4">
                    <div class="text-center">
                        <div class="flex items-center justify-center mb-3">
                            <i class="fas fa-qrcode text-2xl text-purple-500 mr-2"></i>
                            <span class="font-bold text-lg text-gray-800">QRIS</span>
                            <span class="ml-2 bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded">Semua Bank & E-wallet</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">Scan QR Code untuk pembayaran</p>
                        <div class="bg-gray-50 p-4 rounded-lg inline-block">
                            <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS Code" class="w-64 h-64 object-contain mx-auto">
                        </div>
                        <p class="text-xs text-gray-500 mt-3">
                            <i class="fas fa-info-circle text-blue-500"></i> 
                            Scan dengan aplikasi mobile banking atau e-wallet apapun
                        </p>
                    </div>
                </div>
                @endif
            </div>
            @endif
            
            @if($order->payment->payment_method === 'ewallet')
            <!-- E-Wallet -->
            <div class="space-y-4">
                <p class="text-sm text-gray-700 font-semibold">Silakan transfer ke salah satu e-wallet berikut:</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- GoPay -->
                    <div class="bg-white border-2 border-green-500 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-green-500 text-white px-3 py-1 rounded font-bold text-sm">GoPay</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor HP</p>
                        <p class="text-lg font-bold text-gray-800">081234567890</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                    
                    <!-- OVO -->
                    <div class="bg-white border-2 border-purple-600 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-purple-600 text-white px-3 py-1 rounded font-bold text-sm">OVO</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor HP</p>
                        <p class="text-lg font-bold text-gray-800">081234567890</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                    
                    <!-- DANA -->
                    <div class="bg-white border-2 border-blue-400 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-blue-400 text-white px-3 py-1 rounded font-bold text-sm">DANA</div>
                        </div>
                        <p class="text-xs text-gray-600">Nomor HP</p>
                        <p class="text-lg font-bold text-gray-800">081234567890</p>
                        <p class="text-sm text-gray-700 font-semibold mt-1">a.n. MOZU Jasuke</p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Amount to Transfer -->
            <div class="bg-yellow-100 border-2 border-yellow-400 rounded-lg p-4 mt-4">
                <p class="text-sm text-gray-700 mb-1">Jumlah Transfer:</p>
                <p class="text-3xl font-bold text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-600 mt-1">⚠️ Transfer sesuai nominal agar mudah diverifikasi</p>
            </div>
            
            <!-- WhatsApp Confirmation -->
            <div class="bg-green-50 border-2 border-green-400 rounded-lg p-4 mt-4">
                <div class="flex items-start">
                    <i class="fab fa-whatsapp text-3xl text-green-600 mr-3"></i>
                    <div class="flex-1">
                        <p class="font-bold text-gray-800 mb-2">Konfirmasi Pembayaran via WhatsApp</p>
                        <p class="text-sm text-gray-700 mb-3">Setelah transfer, kirim bukti pembayaran ke:</p>
                        <a href="https://wa.me/6281234567890?text=Halo%20MOZU%2C%20saya%20sudah%20transfer%20untuk%20pesanan%20{{ $order->order_number }}%20sebesar%20Rp%20{{ number_format($order->total_amount, 0, ',', '.') }}" 
                           target="_blank"
                           class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                            <i class="fab fa-whatsapp mr-2"></i>
                            0812-3456-7890
                            <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                        </a>
                        <p class="text-xs text-gray-600 mt-2">Sertakan: Nomor Pesanan & Bukti Transfer</p>
                    </div>
                </div>
            </div>
            
            <!-- Instructions -->
            <div class="mt-4 bg-white rounded-lg p-4 border border-gray-200">
                <p class="font-semibold text-gray-800 mb-2 flex items-center">
                    <i class="fas fa-list-ol text-orange-600 mr-2"></i>
                    Langkah Pembayaran:
                </p>
                <ol class="text-sm text-gray-700 space-y-1 ml-6 list-decimal">
                    <li>Transfer ke salah satu rekening/e-wallet di atas</li>
                    <li>Screenshot/foto bukti transfer</li>
                    <li>Kirim ke WhatsApp dengan nomor pesanan: <strong class="text-orange-600">{{ $order->order_number }}</strong></li>
                    <li>Tunggu konfirmasi dari admin (biasanya 5-15 menit)</li>
                    <li>Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
                </ol>
            </div>
        </div>
        @endif

        @if($order->payment->payment_method === 'cash')
        <!-- Cash Payment Info -->
        <div class="bg-green-50 border-2 border-green-200 rounded-lg p-6 mb-6 text-left">
            <div class="flex items-start">
                <i class="fas fa-money-bill-wave text-3xl text-green-600 mr-4"></i>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Pembayaran Tunai</h3>
                    <p class="text-sm text-gray-700 mb-2">Silakan datang ke lokasi dan lakukan pembayaran di kasir.</p>
                    <p class="text-sm text-gray-700">Tunjukkan nomor pesanan: <span class="font-bold text-orange-600">{{ $order->order_number }}</span></p>
                </div>
            </div>
        </div>
        @endif
        
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
            @auth
                <a href="{{ route('order.my-orders') }}" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition duration-300">
                    <i class="fas fa-receipt"></i> Lihat Pesanan Saya
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection

