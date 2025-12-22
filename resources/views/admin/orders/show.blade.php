@extends('layouts.admin')

@section('title', 'Detail Pesanan - MOZU')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <!-- Order Info -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pesanan</h2>
            
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
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Nama Pelanggan</p>
                    <p class="font-semibold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">No. WhatsApp</p>
                    <p class="font-semibold">{{ $order->customer_phone }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600">Metode Pengambilan</p>
                <p class="font-semibold">{{ $order->pickup_method === 'takeaway' ? 'Take Away' : 'Dine In' }}</p>
            </div>
            
            @if($order->notes)
                <div>
                    <p class="text-sm text-gray-600">Catatan</p>
                    <p class="font-semibold">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
        
        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Item Pesanan</h2>
            
            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between border-b pb-3">
                        <div class="flex items-center">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-300 rounded flex items-center justify-center">
                                    <i class="fas fa-corn text-2xl text-white"></i>
                                </div>
                            @endif
                            <div class="ml-4">
                                <p class="font-semibold">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="font-bold text-orange-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
            
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total</span>
                    <span class="text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="lg:col-span-1">
        <!-- Status & Payment -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Status Pesanan</h2>
            
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Ubah Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Dibayar</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-orange-700 transition">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </form>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Info Pembayaran</h2>
            
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-semibold">{{ strtoupper($order->payment->payment_method) }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Status Pembayaran</p>
                    @php
                        $paymentStatusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'paid' => 'bg-green-100 text-green-800',
                            'failed' => 'bg-red-100 text-red-800',
                        ];
                    @endphp
                    <span class="inline-block px-2 py-1 rounded text-sm {{ $paymentStatusColors[$order->payment->status] }}">
                        {{ ucfirst($order->payment->status) }}
                    </span>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Jumlah</p>
                    <p class="font-bold text-lg text-orange-600">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</p>
                </div>
                
                @if($order->payment->paid_at)
                    <div>
                        <p class="text-sm text-gray-600">Dibayar Pada</p>
                        <p class="font-semibold">{{ $order->payment->paid_at->format('d M Y, H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>
        
        <a href="{{ route('admin.orders.index') }}" class="block mt-6 text-center text-orange-600 hover:text-orange-700 font-semibold">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
        </a>
    </div>
</div>
@endsection

