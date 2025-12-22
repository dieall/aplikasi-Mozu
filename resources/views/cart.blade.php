@extends('layouts.app')

@section('title', 'Keranjang - MOZU')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Keranjang Belanja</h1>
    
    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md">
                    @foreach($cart as $id => $item)
                        <div class="flex items-center p-4 border-b last:border-b-0">
                            <div class="w-24 h-24 flex-shrink-0">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-orange-400 to-yellow-300 rounded flex items-center justify-center">
                                        <i class="fas fa-corn text-3xl text-white"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-1 ml-4">
                                <h3 class="text-lg font-bold text-gray-800">{{ $item['name'] }}</h3>
                                <p class="text-orange-600 font-semibold">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="mx-4 font-semibold">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <div class="ml-4 text-right">
                                <p class="text-lg font-bold text-gray-800">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i> Kosongkan Keranjang
                    </button>
                </form>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('order.checkout') }}" class="block w-full bg-orange-600 text-white text-center py-3 rounded-lg hover:bg-orange-700 transition duration-300 font-semibold">
                        <i class="fas fa-credit-card"></i> Checkout
                    </a>
                    
                    <a href="{{ route('home') }}" class="block w-full mt-3 text-center text-orange-600 hover:text-orange-700">
                        <i class="fas fa-arrow-left"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-shopping-cart text-6xl text-gray-400 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kosong</h2>
            <p class="text-gray-600 mb-6">Belum ada produk di keranjang Anda.</p>
            <a href="{{ route('home') }}" class="inline-block bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition duration-300">
                <i class="fas fa-shopping-bag"></i> Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection

