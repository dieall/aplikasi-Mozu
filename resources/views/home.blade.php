@extends('layouts.app')

@section('title', 'Home - MOZU')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-orange-500 via-orange-400 to-yellow-500 rounded-2xl shadow-2xl overflow-hidden mb-12">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-white transform -skew-y-6"></div>
        </div>
        <div class="relative px-6 py-10 sm:px-8 sm:py-12 lg:px-12 lg:py-16">
            <div class="max-w-3xl">
                <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-1 rounded-full text-white text-sm font-semibold mb-4">
                    <i class="fas fa-fire-alt mr-1"></i> Jasuke Mozarella Terbaik di Kota!
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold mb-4 text-white drop-shadow-lg">
                    Selamat Datang di <span class="text-yellow-200">MOZU</span>
                </h1>
                <p class="text-base sm:text-lg lg:text-xl mb-6 text-white/95 leading-relaxed">
                    Nikmati Jasuke Mozarella terbaik dengan kemudahan pemesanan digital. Jagung manis yang dipadukan dengan keju mozzarella yang lembut!
                </p>
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <div class="bg-white text-orange-600 px-5 py-2.5 rounded-xl font-bold shadow-lg hover:scale-105 transition transform">
                        <i class="fas fa-star text-yellow-400"></i> 4.8/5.0
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm text-white px-5 py-2.5 rounded-xl font-semibold">
                        <i class="fas fa-clock"></i> Buka: 10:00 - 21:00
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm text-white px-5 py-2.5 rounded-xl font-semibold hidden sm:block">
                        <i class="fas fa-map-marker-alt"></i> Lokasi: UMKM Center
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="mb-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-3">Menu Kami</h2>
            <p class="text-gray-600 text-lg">Pilih varian favorit Anda!</p>
        </div>
        
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-orange-400 via-orange-300 to-yellow-300 flex items-center justify-center group-hover:from-orange-500 group-hover:to-yellow-400 transition-all duration-500">
                                    <i class="fas fa-corn text-7xl text-white drop-shadow-lg"></i>
                                </div>
                            @endif
                            
                            @if($product->stock <= 5)
                                <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-pulse">
                                    <i class="fas fa-exclamation-circle"></i> Stok Terbatas
                                </span>
                            @endif

                            @if(!$product->is_available || $product->stock == 0)
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                    <span class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold text-lg">
                                        HABIS
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                {{ $product->description }}
                            </p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-2xl font-extrabold text-orange-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg">
                                    <i class="fas fa-box"></i> Stok: {{ $product->stock }}
                                </span>
                            </div>
                            
                            @if($product->is_available && $product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-full bg-gradient-to-r from-orange-600 to-orange-500 text-white py-3 rounded-xl hover:from-orange-700 hover:to-orange-600 transition-all duration-300 font-bold shadow-md hover:shadow-lg transform hover:scale-105">
                                        <i class="fas fa-cart-plus mr-2"></i> Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-400 text-white py-3 rounded-xl font-bold cursor-not-allowed opacity-60">
                                    <i class="fas fa-times-circle mr-2"></i> Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-2xl">
                <i class="fas fa-inbox text-7xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 text-xl font-semibold">Belum ada produk tersedia.</p>
                <p class="text-gray-500 mt-2">Silakan cek kembali nanti!</p>
            </div>
        @endif
    </div>

    <!-- Why Choose Us Section -->
    <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-2xl shadow-xl p-8 sm:p-10 lg:p-12 mb-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-3">Keunggulan Aplikasi MOZU</h2>
            <p class="text-gray-600 text-lg">Solusi digital untuk UMKM modern</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- Keunggulan 1 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-orange-500 to-orange-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-rocket text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">Pemesanan Cepat</h3>
                <p class="text-gray-600 text-sm">Sistem terintegrasi & mudah digunakan</p>
            </div>

            <!-- Keunggulan 2 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-green-500 to-green-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-shield-alt text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">Pembayaran Aman</h3>
                <p class="text-gray-600 text-sm">Digital, praktis & terpercaya</p>
            </div>

            <!-- Keunggulan 3 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-blue-500 to-blue-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-chart-line text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">Laporan Otomatis</h3>
                <p class="text-gray-600 text-sm">Pencatatan & statistik real-time</p>
            </div>

            <!-- Keunggulan 4 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-purple-500 to-purple-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-qrcode text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">QRIS Ready</h3>
                <p class="text-gray-600 text-sm">Upload QRIS sendiri - Scan & Go</p>
            </div>

            <!-- Keunggulan 5 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-pink-500 to-pink-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-chart-bar text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">Dashboard Real-Time</h3>
                <p class="text-gray-600 text-sm">Monitor penjualan secara live</p>
            </div>

            <!-- Keunggulan 6 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-boxes text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">Stok Otomatis</h3>
                <p class="text-gray-600 text-sm">Manajemen stok terupdate otomatis</p>
            </div>

            <!-- Keunggulan 7 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-teal-500 to-teal-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fab fa-whatsapp text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">WhatsApp Ready</h3>
                <p class="text-gray-600 text-sm">Konfirmasi pembayaran cepat</p>
            </div>

            <!-- Keunggulan 8 -->
            <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="bg-gradient-to-br from-red-500 to-red-400 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="fas fa-mobile-alt text-3xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-800">100% Responsive</h3>
                <p class="text-gray-600 text-sm">Sempurna di HP, Tablet & PC</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-orange-600 to-orange-500 rounded-2xl shadow-2xl p-8 sm:p-12 text-center text-white mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4">Siap Memesan?</h2>
        <p class="text-lg sm:text-xl mb-8 text-white/90">Rasakan kemudahan pemesanan digital dengan MOZU!</p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ route('cart.index') }}" class="bg-white text-orange-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 inline-flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i> Lihat Keranjang
            </a>
            @auth
                <a href="{{ route('order.my-orders') }}" class="bg-orange-800 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-orange-900 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 inline-flex items-center">
                    <i class="fas fa-receipt mr-2"></i> Pesanan Saya
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-orange-800 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-orange-900 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 inline-flex items-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login Dulu
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection

