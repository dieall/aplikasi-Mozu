@extends('layouts.admin')

@section('title', 'Dashboard Admin - MOZU')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-box text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Produk</p>
                <p class="text-2xl font-bold">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-shopping-bag text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Pesanan</p>
                <p class="text-2xl font-bold">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-clock text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Pesanan Hari Ini</p>
                <p class="text-2xl font-bold">{{ $todayOrders }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-money-bill-wave text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Revenue</p>
                <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Today -->
<div class="bg-gradient-to-r from-orange-500 to-yellow-500 rounded-lg shadow-md p-6 mb-6 text-white">
    <h3 class="text-xl font-bold mb-2">Pendapatan Hari Ini</h3>
    <p class="text-3xl font-bold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Pesanan Terbaru</h2>
        
        @if($recentOrders->count() > 0)
            <div class="space-y-3">
                @foreach($recentOrders as $order)
                    <div class="border-l-4 border-orange-500 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-sm">{{ $order->order_number }}</p>
                                <p class="text-sm text-gray-600">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-blue-100 text-blue-800',
                                        'processing' => 'bg-purple-100 text-purple-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                    ];
                                @endphp
                                <span class="text-xs px-2 py-1 rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <a href="{{ route('admin.orders.index') }}" class="block mt-4 text-center text-orange-600 hover:text-orange-700 font-semibold">
                Lihat Semua Pesanan →
            </a>
        @else
            <p class="text-gray-600 text-center py-4">Belum ada pesanan.</p>
        @endif
    </div>
    
    <!-- Top Products -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Produk Terlaris</h2>
        
        @if($topProducts->count() > 0)
            <div class="space-y-3">
                @foreach($topProducts as $product)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                        <div class="flex items-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-yellow-300 rounded flex items-center justify-center">
                                    <i class="fas fa-corn text-white"></i>
                                </div>
                            @endif
                            <div class="ml-3">
                                <p class="font-semibold">{{ $product->name }}</p>
                                <p class="text-sm text-gray-600">Stok: {{ $product->stock }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-orange-600">{{ $product->order_items_count }}</p>
                            <p class="text-xs text-gray-600">terjual</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <a href="{{ route('admin.products.index') }}" class="block mt-4 text-center text-orange-600 hover:text-orange-700 font-semibold">
                Kelola Produk →
            </a>
        @else
            <p class="text-gray-600 text-center py-4">Belum ada data penjualan.</p>
        @endif
    </div>
</div>
@endsection

