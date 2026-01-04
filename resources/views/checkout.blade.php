@extends('layouts.app')

@section('title', 'Checkout - MOZU')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center text-sm text-gray-600 mb-4">
            <a href="{{ route('home') }}" class="hover:text-orange-600">Home</a>
            <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <a href="{{ route('cart.index') }}" class="hover:text-orange-600">Keranjang</a>
            <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <span class="text-orange-600 font-semibold">Checkout</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
            <i class="fas fa-shopping-cart text-orange-600 mr-2"></i>
            Checkout Pesanan
        </h1>
        <p class="text-gray-600 mt-2">Lengkapi data berikut untuk menyelesaikan pesanan Anda</p>
    </div>
    
    <form action="{{ route('order.store') }}" method="POST" id="checkout-form">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <!-- Step 1: Data Pelanggan -->
                <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border-t-4 border-orange-500">
                    <div class="flex items-center mb-6">
                        <div class="bg-orange-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mr-3">
                            1
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Data Pelanggan</h2>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <label for="customer_name" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="fas fa-user text-orange-500 mr-2"></i>
                                Nama Lengkap <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="customer_name" name="customer_name" value="{{ auth()->user()->name ?? old('customer_name') }}" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition @error('customer_name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap Anda">
                            @error('customer_name')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="customer_phone" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="fab fa-whatsapp text-green-500 mr-2"></i>
                                No. WhatsApp <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="customer_phone" name="customer_phone" value="{{ auth()->user()->phone ?? old('customer_phone') }}" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition @error('customer_phone') border-red-500 @enderror"
                                placeholder="08xxxxxxxxxx">
                            @error('customer_phone')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Nomor ini akan digunakan untuk konfirmasi pesanan
                            </p>
                        </div>
                        
                        <div>
                            <label for="notes" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="fas fa-sticky-note text-yellow-500 mr-2"></i>
                                Catatan <span class="text-gray-400 text-sm ml-1">(Opsional)</span>
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                                placeholder="Tambahkan catatan khusus untuk pesanan Anda...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Metode Pengambilan -->
                <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border-t-4 border-green-500">
                    <div class="flex items-center mb-6">
                        <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mr-3">
                            2
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Metode Pengambilan</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="cursor-pointer group">
                            <input type="radio" name="pickup_method" value="takeaway" checked class="hidden peer">
                            <div class="border-3 border-gray-300 rounded-xl p-6 text-center peer-checked:border-green-600 peer-checked:bg-green-50 hover:border-green-400 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                <i class="fas fa-shopping-bag text-5xl text-green-600 mb-3"></i>
                                <p class="font-bold text-lg mb-1">Take Away</p>
                                <p class="text-sm text-gray-600">Bawa pulang</p>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer group">
                            <input type="radio" name="pickup_method" value="dine_in" class="hidden peer">
                            <div class="border-3 border-gray-300 rounded-xl p-6 text-center peer-checked:border-green-600 peer-checked:bg-green-50 hover:border-green-400 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                <i class="fas fa-utensils text-5xl text-green-600 mb-3"></i>
                                <p class="font-bold text-lg mb-1">Dine In</p>
                                <p class="text-sm text-gray-600">Makan di tempat</p>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Step 3: Metode Pembayaran -->
                <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border-t-4 border-blue-500">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mr-3">
                            3
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Metode Pembayaran</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <label class="block cursor-pointer group">
                            <input type="radio" name="payment_method" value="transfer" checked class="hidden peer">
                            <div class="flex items-center p-5 border-3 border-blue-500 bg-blue-50 rounded-xl peer-checked:border-blue-600 peer-checked:shadow-lg hover:shadow-md transition-all duration-300">
                                <div class="bg-blue-500 text-white p-3 rounded-lg mr-4">
                                    <i class="fas fa-university text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <p class="font-bold text-lg text-gray-800">Transfer Bank / QRIS</p>
                                        <span class="ml-3 px-3 py-1 bg-blue-500 text-white text-xs rounded-full font-semibold">
                                            <i class="fas fa-star mr-1"></i>Direkomendasikan
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">BCA, Mandiri, BRI, BNI, atau scan QRIS</p>
                                </div>
                                <i class="fas fa-check-circle text-3xl text-blue-600 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                        </label>
                        
                        <label class="block cursor-pointer group">
                            <input type="radio" name="payment_method" value="ewallet" class="hidden peer">
                            <div class="flex items-center p-5 border-3 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-purple-50 peer-checked:shadow-lg hover:shadow-md hover:border-purple-400 transition-all duration-300">
                                <div class="bg-purple-500 text-white p-3 rounded-lg mr-4">
                                    <i class="fas fa-wallet text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-lg text-gray-800">E-Wallet</p>
                                    <p class="text-sm text-gray-600 mt-1">GoPay, OVO, DANA</p>
                                </div>
                                <i class="fas fa-check-circle text-3xl text-purple-600 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                        </label>
                        
                        <label class="block cursor-pointer group">
                            <input type="radio" name="payment_method" value="cash" class="hidden peer">
                            <div class="flex items-center p-5 border-3 border-gray-300 rounded-xl peer-checked:border-green-600 peer-checked:bg-green-50 peer-checked:shadow-lg hover:shadow-md hover:border-green-400 transition-all duration-300">
                                <div class="bg-green-500 text-white p-3 rounded-lg mr-4">
                                    <i class="fas fa-money-bill-wave text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-lg text-gray-800">Tunai</p>
                                    <p class="text-sm text-gray-600 mt-1">Bayar di kasir</p>
                                </div>
                                <i class="fas fa-check-circle text-3xl text-green-600 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-orange-500 to-yellow-500 rounded-2xl shadow-2xl p-6 sm:p-8 text-white sticky top-4">
                    <div class="flex items-center justify-center mb-6">
                        <i class="fas fa-receipt text-4xl mr-3"></i>
                        <h2 class="text-2xl font-bold">Ringkasan Pesanan</h2>
                    </div>
                    
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 mb-4">
                        <div class="space-y-3">
                            @foreach($cart as $item)
                                <div class="flex justify-between items-start text-sm border-b border-white/20 pb-2 last:border-0 last:pb-0">
                                    <div class="flex-1 pr-2">
                                        <p class="font-semibold">{{ $item['name'] }}</p>
                                        <p class="text-xs text-white/70">
                                            {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <span class="font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-white/80">Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-white/80">Biaya Admin</span>
                            <span class="font-semibold">Rp 0</span>
                        </div>
                        <div class="border-t border-white/30 pt-3 mt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold">Total</span>
                                <span class="text-3xl font-extrabold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-white text-orange-600 py-4 rounded-xl hover:bg-gray-100 transition duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-check-circle mr-2"></i> Buat Pesanan
                    </button>
                    
                    <div class="mt-4 text-center text-sm text-white/80">
                        <i class="fas fa-lock mr-1"></i> Transaksi Aman & Terpercaya
                    </div>
                </div>
                
                <!-- Info Box -->
                <div class="mt-6 bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                    <h3 class="font-bold text-blue-800 mb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Penting
                    </h3>
                    <ul class="text-sm text-blue-700 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-2 mt-1"></i>
                            <span>Pesanan akan diproses setelah pembayaran dikonfirmasi</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-2 mt-1"></i>
                            <span>Anda akan menerima nomor pesanan setelah checkout</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-600 mr-2 mt-1"></i>
                            <span>Konfirmasi pembayaran via WhatsApp</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Form validation
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const name = document.getElementById('customer_name').value.trim();
    const phone = document.getElementById('customer_phone').value.trim();
    
    if (!name || !phone) {
        e.preventDefault();
        alert('Mohon lengkapi semua data yang wajib diisi!');
        return false;
    }
    
    // Show loading
    const btn = this.querySelector('button[type="submit"]');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
    btn.disabled = true;
});
</script>
@endsection

