<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        $totalRevenue = Order::whereIn('status', ['paid', 'processing', 'completed'])->sum('total_amount');
        $todayRevenue = Order::whereIn('status', ['paid', 'processing', 'completed'])
            ->whereDate('created_at', today())
            ->sum('total_amount');

        $recentOrders = Order::with(['orderItems.product', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $topProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'todayOrders',
            'totalRevenue',
            'todayRevenue',
            'recentOrders',
            'topProducts'
        ));
    }

    public function reports()
    {
        $dailySales = Order::whereIn('status', ['paid', 'processing', 'completed'])
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_sales')
            )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.reports', compact('dailySales'));
    }
}
