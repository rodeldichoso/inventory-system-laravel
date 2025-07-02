<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\OrderItem;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $productsCount = Product::count();
        $salesCount = OrderItem::count();
        $totalStock = Product::sum('stock');
        $ordersCount = \App\Models\Order::count();
        $suppliersCount = Supplier::count();
        $categoriesCount = Category::count();


        // Get the top-selling product based on the total quantity sold
        $topProductId = OrderItem::select('product_id')
            ->selectRaw('SUM(quantity) as sold_count')
            ->groupBy('product_id')
            ->orderByDesc('sold_count')
            ->limit(1)
            ->pluck('product_id')
            ->first();

        // If there is a top product, fetch its details and calculate sold count
        $topProduct = null;
        if ($topProductId) {
            $topProduct = Product::find($topProductId);
            $topProduct->sold_count = OrderItem::where('product_id', $topProductId)->sum('quantity');
        }

        // Get products with low stock (less than 20)
        $lowStockProducts = Product::where('stock', '<', 20)->get();

        // Get the latest activity and the user who performed it
        $latestActivity = Activity::with('user')->latest()->first();
        $activityUserName = $latestActivity && $latestActivity->user ? $latestActivity->user->name : null;
        $activityDescription = $latestActivity ? $latestActivity->description : null;

        // Get the latest 5 activities with user info (no map, pass raw models)
        $recentActivities = Activity::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'productsCount',
            'salesCount',
            'totalStock',
            'ordersCount',
            'topProduct',
            'lowStockProducts',
            'suppliersCount',
            'categoriesCount',
            'recentActivities'
        ));
    }
}
