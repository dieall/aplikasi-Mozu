@extends('layouts.admin')

@section('title', 'Laporan - MOZU')
@section('page-title', 'Laporan Penjualan')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Penjualan 30 Hari Terakhir</h2>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pesanan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($dailySales as $sale)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-semibold">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ $sale->total_orders }} pesanan</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-orange-600">Rp {{ number_format($sale->total_sales, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-600">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p>Belum ada data penjualan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if($dailySales->count() > 0)
                <tfoot class="bg-gray-50">
                    <tr>
                        <td class="px-6 py-4 font-bold">Total</td>
                        <td class="px-6 py-4 font-bold">{{ $dailySales->sum('total_orders') }} pesanan</td>
                        <td class="px-6 py-4 font-bold text-orange-600">Rp {{ number_format($dailySales->sum('total_sales'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection

