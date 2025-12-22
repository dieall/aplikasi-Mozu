@extends('layouts.app')

@section('title', 'Home - MOZU')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-orange-500 to-yellow-500 rounded-lg shadow-lg p-8 mb-8 text-white">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di MOZU</h1>
            <p class="text-lg mb-6">Nikmati Jasuke Mozarella terbaik dengan kemudahan pemesanan digital. Jagung manis yang dipadukan dengan keju mozzarella yang lembut!</p>
            <div class="flex items-center space-x-4">
                <div class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold">
                    <i class="fas fa-star"></i> 4.8/5.0
                </div>
                <div class="text-white">
                    <i class="fas fa-clock"></i> Buka: 10:00 - 21:00
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Menu Kami</h2>
        
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-yellow-300 flex items-center justify-center">
                                    <i class="fas fa-corn text-6xl text-white"></i>
                                </div>
                            @endif
                            
                            @if($product->stock <= 5)
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    Stok Terbatas
                                </span>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-orange-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-box"></i> Stok: {{ $product->stock }}
                                </span>
                            </div>
                            
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-orange-700 transition duration-300">
                                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-600 text-lg">Belum ada produk tersedia.</p>
            </div>
        @endif
    </div>

    <!-- Why Choose Us Section -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Kenapa Pilih MOZU?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-3xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Cepat & Mudah</h3>
                <p class="text-gray-600">Pesan dalam hitungan detik, tidak perlu antri lama</p>
            </div>
            <div class="text-center">
                <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-3xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Kualitas Terbaik</h3>
                <p class="text-gray-600">Bahan berkualitas dengan keju mozzarella asli</p>
            </div>
            <div class="text-center">
                <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-3xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Pembayaran Fleksibel</h3>
                <p class="text-gray-600">Tunai, Transfer, atau E-wallet</p>
            </div>
        </div>
    </div>
</div>
@endsection

