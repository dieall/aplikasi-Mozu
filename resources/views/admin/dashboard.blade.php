@extends('layouts.admin')

@section('title', 'Dashboard Admin - MOZU')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-orange-600 via-orange-500 to-yellow-500 rounded-2xl shadow-xl p-6 sm:p-8 mb-8 text-white">
    <div class="flex flex-col sm:flex-row items-center justify-between">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p class="text-white/90 text-sm sm:text-base">Berikut ringkasan bisnis MOZU Anda hari ini</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="bg-white/20 backdrop-blur-sm rounded-xl px-6 py-4 text-center">
                <p class="text-sm text-white/80 mb-1">Pendapatan Hari Ini</p>
                <p class="text-3xl font-extrabold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
                <p class="text-3xl font-extrabold text-gray-800">{{ $totalProducts }}</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-check-circle"></i> Aktif
                </p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg">
                <i class="fas fa-box text-3xl text-white"></i>
            </div>
        </div>
    </div>
    
    <!-- Total Orders -->
    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Total Pesanan</p>
                <p class="text-3xl font-extrabold text-gray-800">{{ $totalOrders }}</p>
                <p class="text-xs text-blue-600 mt-1">
                    <i class="fas fa-chart-line"></i> Semua waktu
                </p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 shadow-lg">
                <i class="fas fa-shopping-bag text-3xl text-white"></i>
            </div>
        </div>
    </div>
    
    <!-- Today Orders -->
    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Pesanan Hari Ini</p>
                <p class="text-3xl font-extrabold text-gray-800">{{ $todayOrders }}</p>
                <p class="text-xs text-yellow-600 mt-1">
                    <i class="fas fa-calendar-day"></i> Hari ini
                </p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-yellow-500 to-yellow-600 shadow-lg">
                <i class="fas fa-clock text-3xl text-white"></i>
            </div>
        </div>
    </div>
    
    <!-- Total Revenue -->
    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Total Revenue</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-800">Rp {{ number_format($totalRevenue / 1000, 0) }}K</p>
                <p class="text-xs text-purple-600 mt-1">
                    <i class="fas fa-arrow-up"></i> Semua waktu
                </p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg">
                <i class="fas fa-money-bill-wave text-3xl text-white"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-shopping-bag text-orange-500 mr-2"></i>
                Pesanan Terbaru
            </h2>
            <span class="bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                {{ $recentOrders->count() }} Pesanan
            </span>
        </div>
        
        @if($recentOrders->count() > 0)
            <div class="space-y-3">
                @foreach($recentOrders as $order)
                    <div class="border-l-4 border-orange-500 bg-gray-50 rounded-r-lg pl-4 pr-3 py-3 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-bold text-sm text-gray-800 mb-1">{{ $order->order_number }}</p>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <i class="fas fa-user text-xs mr-2"></i>
                                    {{ $order->customer_name }}
                                </div>
                                <div class="flex items-center text-xs text-gray-500">
                                    <i class="fas fa-clock text-xs mr-2"></i>
                                    {{ $order->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-orange-600 mb-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                @php
                                    $statusConfig = [
                                        'pending' => ['class' => 'bg-yellow-100 text-yellow-800', 'icon' => 'clock'],
                                        'paid' => ['class' => 'bg-blue-100 text-blue-800', 'icon' => 'check'],
                                        'processing' => ['class' => 'bg-purple-100 text-purple-800', 'icon' => 'spinner'],
                                        'completed' => ['class' => 'bg-green-100 text-green-800', 'icon' => 'check-circle'],
                                    ];
                                    $config = $statusConfig[$order->status] ?? ['class' => 'bg-gray-100', 'icon' => 'question'];
                                @endphp
                                <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $config['class'] }}">
                                    <i class="fas fa-{{ $config['icon'] }} mr-1"></i>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <a href="{{ route('admin.orders.index') }}" class="block mt-6 text-center bg-orange-50 text-orange-600 hover:bg-orange-100 hover:text-orange-700 font-semibold py-3 rounded-lg transition-colors">
                Lihat Semua Pesanan <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-300 text-5xl mb-3"></i>
                <p class="text-gray-500">Belum ada pesanan.</p>
            </div>
        @endif
    </div>
    
    <!-- Top Products -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-fire text-red-500 mr-2"></i>
                Produk Terlaris
            </h2>
            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                Top {{ $topProducts->count() }}
            </span>
        </div>
        
        @if($topProducts->count() > 0)
            <div class="space-y-3">
                @foreach($topProducts as $index => $product)
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-white rounded-lg hover:shadow-md transition-shadow border border-gray-100">
                        <div class="flex items-center flex-1">
                            <!-- Rank Badge -->
                            <div class="w-8 h-8 rounded-full {{ $index == 0 ? 'bg-gradient-to-br from-yellow-400 to-yellow-500' : ($index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-400' : 'bg-gradient-to-br from-orange-300 to-orange-400') }} flex items-center justify-center text-white font-bold text-sm mr-3 shadow">
                                {{ $index + 1 }}
                            </div>
                            
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-14 h-14 object-cover rounded-lg shadow-sm">
                            @else
                                <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-yellow-300 rounded-lg flex items-center justify-center shadow-sm">
                                    <i class="fas fa-corn text-white text-xl"></i>
                                </div>
                            @endif
                            
                            <div class="ml-3 flex-1">
                                <p class="font-bold text-gray-800">{{ $product->name }}</p>
                                <div class="flex items-center text-xs text-gray-500 mt-1">
                                    <i class="fas fa-box mr-1"></i>
                                    Stok: <span class="font-semibold ml-1 {{ $product->stock <= 5 ? 'text-red-600' : 'text-green-600' }}">{{ $product->stock }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-right ml-3">
                            <p class="text-2xl font-extrabold text-orange-600">{{ $product->order_items_count }}</p>
                            <p class="text-xs text-gray-500 font-medium">terjual</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <a href="{{ route('admin.products.index') }}" class="block mt-6 text-center bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-700 font-semibold py-3 rounded-lg transition-colors">
                Kelola Semua Produk <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @else
            <div class="text-center py-12">
                <i class="fas fa-box-open text-gray-300 text-5xl mb-3"></i>
                <p class="text-gray-500">Belum ada data penjualan.</p>
            </div>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
    <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
        <i class="fas fa-plus-circle text-3xl mb-2"></i>
        <p class="font-bold">Tambah Produk Baru</p>
        <p class="text-sm text-blue-100 mt-1">Tambahkan menu baru</p>
    </a>
    
    <a href="{{ route('admin.orders.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
        <i class="fas fa-list-alt text-3xl mb-2"></i>
        <p class="font-bold">Lihat Semua Pesanan</p>
        <p class="text-sm text-purple-100 mt-1">Kelola pesanan masuk</p>
    </a>
    
    <a href="{{ route('admin.reports') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
        <i class="fas fa-chart-pie text-3xl mb-2"></i>
        <p class="font-bold">Lihat Laporan</p>
        <p class="text-sm text-pink-100 mt-1">Analisis penjualan</p>
    </a>
</div>
@endsection

