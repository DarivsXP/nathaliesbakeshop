<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomCakeInquiry;
use App\Models\Order;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $todayOrders = Order::query()
            ->whereDate('created_at', today())
            ->count();

        $pendingOrders = Order::query()
            ->where('status', 'pending')
            ->count();

        $newInquiries = CustomCakeInquiry::query()
            ->where('status', 'new')
            ->count();

        $recentOrders = Order::query()
            ->with('items')
            ->latest()
            ->take(5)
            ->get();

        $recentInquiries = CustomCakeInquiry::query()
            ->latest()
            ->take(5)
            ->get();

        $totalProducts = Product::query()->where('is_active', true)->count();

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'todayOrders' => $todayOrders,
                'pendingOrders' => $pendingOrders,
                'newInquiries' => $newInquiries,
                'totalProducts' => $totalProducts,
            ],
            'recentOrders' => $recentOrders,
            'recentInquiries' => $recentInquiries,
        ]);
    }
}
