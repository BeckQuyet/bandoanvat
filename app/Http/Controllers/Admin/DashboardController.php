<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

/**
 * DashboardController - Trang tong quan cho admin
 * Hien thi thong ke va don hang gan day
 */
class DashboardController extends Controller
{
    // Thong ke: so san pham, don hang, khach hang, doanh thu, don cho xu ly
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::where('role', 'user')->count(),
            'categories' => Category::count(),
            'revenue' => Order::where('status', 'completed')->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
