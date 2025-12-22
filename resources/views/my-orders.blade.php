@extends('layouts.app')

@section('title', 'Pesanan Saya - MOZU')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Pesanan Saya</h1>
    
    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Nomor Pesanan</p>
                            <p class="font-bold text-lg text-orange-600">{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="mt-3 md:mt-0">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'paid' => 'bg-blue-100 text-blue-800',
                                    'processing' => 'bg-purple-100 text-purple-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu',
                                    'paid' => 'Dibayar',
                                    'processing' => 'Diproses',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$order->status] }}">
                                {{ $statusLabels[$order->status] }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h3 class="font-bold mb-2">Item Pesanan:</h3>
                        <div class="space-y-2">
                            @foreach($order->orderItems as $item)
                                <div class="flex justify-between text-sm">
                                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                                    <span class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="border-t mt-4 pt-4 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total Pembayaran</p>
                            <p class="font-bold text-xl text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right text-sm">
                            <p class="text-gray-600">Metode: {{ strtoupper($order->payment->payment_method) }}</p>
                            <p class="text-gray-600">Pengambilan: {{ $order->pickup_method === 'takeaway' ? 'Take Away' : 'Dine In' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-receipt text-6xl text-gray-400 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h2>
            <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan.</p>
            <a href="{{ route('home') }}" class="inline-block bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition duration-300">
                <i class="fas fa-shopping-bag"></i> Mulai Pesan
            </a>
        </div>
    @endif
</div>
@endsection

