@extends('layouts.app')

@section('title', 'Pembayaran - MOZU')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-6">
            <i class="fas fa-credit-card text-6xl text-orange-600 mb-4"></i>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran</h1>
            <p class="text-gray-600">Pesanan: <span class="font-semibold text-orange-600">{{ $order->order_number }}</span></p>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-700">Total Pembayaran</span>
                <span class="text-3xl font-bold text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center">
            <button id="pay-button" class="bg-orange-600 text-white px-8 py-3 rounded-lg hover:bg-orange-700 transition duration-300 font-semibold text-lg">
                <i class="fas fa-lock"></i> Bayar Sekarang
            </button>
            
            <p class="text-sm text-gray-600 mt-4">
                Anda akan diarahkan ke halaman pembayaran yang aman
            </p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-gray-600 mb-2">Metode pembayaran yang tersedia:</p>
        <div class="flex flex-wrap justify-center gap-4">
            <div class="bg-white rounded-lg p-3 shadow-sm">
                <i class="fas fa-credit-card text-2xl text-blue-600"></i>
                <p class="text-xs mt-1">Kartu Kredit</p>
            </div>
            <div class="bg-white rounded-lg p-3 shadow-sm">
                <i class="fas fa-university text-2xl text-green-600"></i>
                <p class="text-xs mt-1">Bank Transfer</p>
            </div>
            <div class="bg-white rounded-lg p-3 shadow-sm">
                <i class="fas fa-wallet text-2xl text-purple-600"></i>
                <p class="text-xs mt-1">E-Wallet</p>
            </div>
            <div class="bg-white rounded-lg p-3 shadow-sm">
                <i class="fas fa-qrcode text-2xl text-orange-600"></i>
                <p class="text-xs mt-1">QRIS</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log('Payment success:', result);
                window.location.href = '{{ route("payment.finish") }}?order_id={{ $order->order_number }}';
            },
            onPending: function(result) {
                console.log('Payment pending:', result);
                window.location.href = '{{ route("payment.unfinish") }}?order_id={{ $order->order_number }}';
            },
            onError: function(result) {
                console.log('Payment error:', result);
                window.location.href = '{{ route("payment.error") }}?order_id={{ $order->order_number }}';
            },
            onClose: function() {
                console.log('Payment popup closed');
                alert('Anda menutup popup pembayaran. Silakan lanjutkan pembayaran Anda.');
            }
        });
    });
</script>
@endpush

