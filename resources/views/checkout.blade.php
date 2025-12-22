@extends('layouts.app')

@section('title', 'Checkout - MOZU')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>
    
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Data Pelanggan</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="customer_name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" id="customer_name" name="customer_name" value="{{ auth()->user()->name ?? old('customer_name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('customer_name') border-red-500 @enderror">
                            @error('customer_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="customer_phone" class="block text-gray-700 font-semibold mb-2">No. WhatsApp</label>
                            <input type="text" id="customer_phone" name="customer_phone" value="{{ auth()->user()->phone ?? old('customer_phone') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('customer_phone') border-red-500 @enderror">
                            @error('customer_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="notes" class="block text-gray-700 font-semibold mb-2">Catatan (Opsional)</label>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Metode Pengambilan</h2>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="pickup_method" value="takeaway" checked class="hidden peer">
                            <div class="border-2 border-gray-300 rounded-lg p-4 text-center peer-checked:border-orange-600 peer-checked:bg-orange-50 hover:border-orange-400 transition">
                                <i class="fas fa-shopping-bag text-3xl text-orange-600 mb-2"></i>
                                <p class="font-semibold">Take Away</p>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="pickup_method" value="dine_in" class="hidden peer">
                            <div class="border-2 border-gray-300 rounded-lg p-4 text-center peer-checked:border-orange-600 peer-checked:bg-orange-50 hover:border-orange-400 transition">
                                <i class="fas fa-utensils text-3xl text-orange-600 mb-2"></i>
                                <p class="font-semibold">Dine In</p>
                            </div>
                        </label>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 border-blue-500 bg-blue-50 rounded-lg cursor-pointer hover:border-blue-600 transition">
                            <input type="radio" name="payment_method" value="transfer" checked class="mr-3">
                            <i class="fas fa-university text-2xl text-blue-600 mr-3"></i>
                            <div>
                                <p class="font-semibold text-blue-700">Transfer Bank / QRIS</p>
                                <p class="text-sm text-gray-600">BCA, Mandiri, BRI, BNI, atau scan QRIS</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-blue-200 text-blue-800 text-xs rounded">Direkomendasikan</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-orange-400 transition">
                            <input type="radio" name="payment_method" value="ewallet" class="mr-3">
                            <i class="fas fa-wallet text-2xl text-purple-600 mr-3"></i>
                            <div>
                                <p class="font-semibold">E-Wallet</p>
                                <p class="text-sm text-gray-600">GoPay, OVO, DANA</p>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-orange-400 transition">
                            <input type="radio" name="payment_method" value="cash" class="mr-3">
                            <i class="fas fa-money-bill-wave text-2xl text-green-600 mr-3"></i>
                            <div>
                                <p class="font-semibold">Tunai</p>
                                <p class="text-sm text-gray-600">Bayar di kasir</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-4">
                        @foreach($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                                <span class="font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700 transition duration-300 font-semibold">
                        <i class="fas fa-check-circle"></i> Buat Pesanan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

