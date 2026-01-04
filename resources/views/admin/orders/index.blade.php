@extends('layouts.admin')

@section('title', 'Kelola Pesanan - MOZU')
@section('page-title', 'Kelola Pesanan')

@section('content')
<!-- Filter & Search -->
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex-1 w-full sm:w-auto">
        <div class="relative">
            <input type="text" id="search-order" placeholder="Cari nomor pesanan atau nama pelanggan..." 
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
    </div>
    
    <div class="flex gap-3 w-full sm:w-auto">
        <select id="filter-status" class="px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 transition">
            <option value="">Semua Status</option>
            <option value="pending">Menunggu</option>
            <option value="paid">Dibayar</option>
            <option value="processing">Diproses</option>
            <option value="completed">Selesai</option>
            <option value="cancelled">Dibatalkan</option>
        </select>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <div class="bg-gradient-to-br from-gray-500 to-gray-600 text-white rounded-xl p-4 shadow-lg">
        <p class="text-gray-100 text-xs mb-1">Total</p>
        <p class="text-2xl font-bold">{{ $orders->total() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-xl p-4 shadow-lg">
        <p class="text-yellow-100 text-xs mb-1">Menunggu</p>
        <p class="text-2xl font-bold">{{ $orders->where('status', 'pending')->count() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-4 shadow-lg">
        <p class="text-blue-100 text-xs mb-1">Dibayar</p>
        <p class="text-2xl font-bold">{{ $orders->where('status', 'paid')->count() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl p-4 shadow-lg">
        <p class="text-purple-100 text-xs mb-1">Diproses</p>
        <p class="text-2xl font-bold">{{ $orders->where('status', 'processing')->count() }}</p>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-4 shadow-lg">
        <p class="text-green-100 text-xs mb-1">Selesai</p>
        <p class="text-2xl font-bold">{{ $orders->where('status', 'completed')->count() }}</p>
    </div>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="orders-table">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Pesanan</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="orders-tbody">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors order-row" 
                        data-order="{{ strtolower($order->order_number) }}" 
                        data-customer="{{ strtolower($order->customer_name) }}"
                        data-status="{{ $order->status }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-receipt text-orange-600"></i>
                                </div>
                                <span class="font-bold text-orange-600">{{ $order->order_number }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-bold text-gray-800">{{ $order->customer_name }}</p>
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i class="fab fa-whatsapp text-green-600 mr-1"></i>
                                    {{ $order->customer_phone }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-lg text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusConfig = [
                                    'pending' => ['class' => 'bg-yellow-100 text-yellow-800 border-yellow-300', 'icon' => 'clock', 'label' => 'Menunggu'],
                                    'paid' => ['class' => 'bg-blue-100 text-blue-800 border-blue-300', 'icon' => 'check', 'label' => 'Dibayar'],
                                    'processing' => ['class' => 'bg-purple-100 text-purple-800 border-purple-300', 'icon' => 'spinner', 'label' => 'Diproses'],
                                    'completed' => ['class' => 'bg-green-100 text-green-800 border-green-300', 'icon' => 'check-circle', 'label' => 'Selesai'],
                                    'cancelled' => ['class' => 'bg-red-100 text-red-800 border-red-300', 'icon' => 'times-circle', 'label' => 'Dibatalkan'],
                                ];
                                $config = $statusConfig[$order->status] ?? ['class' => 'bg-gray-100', 'icon' => 'question', 'label' => 'Unknown'];
                            @endphp
                            <span class="px-3 py-2 rounded-lg text-sm font-semibold border-2 {{ $config['class'] }}">
                                <i class="fas fa-{{ $config['icon'] }} mr-1"></i>
                                {{ $config['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <p class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y') }}</p>
                                <p class="text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.orders.show', $order) }}" 
                                class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-md hover:shadow-lg transform hover:scale-105">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr id="empty-state">
                        <td colspan="6" class="px-6 py-16 text-center">
                            <i class="fas fa-shopping-bag text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-semibold">Belum ada pesanan.</p>
                            <p class="text-gray-400 mt-2">Pesanan customer akan muncul di sini</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($orders->hasPages())
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endif

<script>
// Search functionality
document.getElementById('search-order').addEventListener('keyup', function() {
    filterOrders();
});

// Filter functionality
document.getElementById('filter-status').addEventListener('change', function() {
    filterOrders();
});

function filterOrders() {
    const searchTerm = document.getElementById('search-order').value.toLowerCase();
    const filterStatus = document.getElementById('filter-status').value;
    const rows = document.querySelectorAll('.order-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const orderNumber = row.getAttribute('data-order');
        const customer = row.getAttribute('data-customer');
        const status = row.getAttribute('data-status');
        
        let matchSearch = orderNumber.includes(searchTerm) || customer.includes(searchTerm);
        let matchFilter = filterStatus === '' || status === filterStatus;
        
        if (matchSearch && matchFilter) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show/hide empty state
    const emptyState = document.getElementById('empty-state');
    if (emptyState) {
        emptyState.style.display = visibleCount === 0 ? '' : 'none';
    }
}
</script>
@endsection

