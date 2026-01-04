@extends('layouts.admin')

@section('title', 'Kelola Produk - MOZU')
@section('page-title', 'Kelola Produk')

@section('content')
<!-- Header Actions -->
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex-1 w-full sm:w-auto">
        <div class="relative">
            <input type="text" id="search-product" placeholder="Cari produk..." 
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
    </div>
    
    <div class="flex gap-3 w-full sm:w-auto">
        <select id="filter-status" class="px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-orange-500 transition">
            <option value="">Semua Status</option>
            <option value="available">Tersedia</option>
            <option value="unavailable">Tidak Tersedia</option>
        </select>
        
        <a href="{{ route('admin.products.create') }}" 
            class="bg-gradient-to-r from-orange-600 to-orange-500 text-white px-6 py-3 rounded-xl hover:from-orange-700 hover:to-orange-600 transition font-bold shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
            <i class="fas fa-plus mr-2"></i> Tambah Produk
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-5 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm mb-1">Total Produk</p>
                <p class="text-3xl font-bold">{{ $products->total() }}</p>
            </div>
            <i class="fas fa-box text-4xl text-white/30"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-5 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm mb-1">Tersedia</p>
                <p class="text-3xl font-bold">{{ $products->where('is_available', true)->count() }}</p>
            </div>
            <i class="fas fa-check-circle text-4xl text-white/30"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-xl p-5 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-100 text-sm mb-1">Stok Rendah</p>
                <p class="text-3xl font-bold">{{ $products->where('stock', '<=', 5)->count() }}</p>
            </div>
            <i class="fas fa-exclamation-triangle text-4xl text-white/30"></i>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="products-table">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="products-tbody">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors product-row" 
                        data-name="{{ strtolower($product->name) }}" 
                        data-available="{{ $product->is_available ? 'available' : 'unavailable' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-xl shadow-md">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-300 rounded-xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-corn text-white text-2xl"></i>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <p class="font-bold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($product->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-orange-600 text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-2 rounded-lg font-bold text-sm {{ $product->stock <= 5 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                <i class="fas fa-box mr-1"></i>
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($product->is_available)
                                <span class="px-3 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Tersedia
                                </span>
                            @else
                                <span class="px-3 py-2 bg-red-100 text-red-800 rounded-lg text-sm font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i>Tidak Tersedia
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-md hover:shadow-lg transform hover:scale-105">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition shadow-md hover:shadow-lg transform hover:scale-105">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="empty-state">
                        <td colspan="5" class="px-6 py-16 text-center">
                            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-semibold">Belum ada produk.</p>
                            <p class="text-gray-400 mt-2">Klik "Tambah Produk" untuk mulai menambahkan menu</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($products->hasPages())
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endif

<script>
// Search functionality
document.getElementById('search-product').addEventListener('keyup', function() {
    filterProducts();
});

// Filter functionality
document.getElementById('filter-status').addEventListener('change', function() {
    filterProducts();
});

function filterProducts() {
    const searchTerm = document.getElementById('search-product').value.toLowerCase();
    const filterStatus = document.getElementById('filter-status').value;
    const rows = document.querySelectorAll('.product-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const available = row.getAttribute('data-available');
        
        let matchSearch = name.includes(searchTerm);
        let matchFilter = filterStatus === '' || available === filterStatus;
        
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

