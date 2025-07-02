<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Actions (moved to top) -->

            <div class="mb-10">
                <div class="bg-gradient-to-br from-yellow-50 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col md:flex-row gap-6 items-center justify-center">
                    <div class="text-2xl font-bold text-amber-800 flex items-center gap-2 mb-4 md:mb-0 md:mr-8">
                        <span>⚡</span> Quick Actions
                    </div>
                    <div class="flex flex-col md:flex-row flex-nowrap gap-4 w-full md:w-auto overflow-x-auto">
                        <a href="{{ route('products.create', ['from' => 'dashboard']) }}" class="bg-amber-600 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition text-center">+ Add New Product</a>
                        <a href="{{ route('orderitems.create', ['from' => 'dashboard']) }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-blue-600 transition text-center">+ Record Sale</a>
                        <a href="{{ route('products.index') }}" class="bg-yellow-400 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-yellow-500 transition text-center">View All Products</a>
                        <a href="{{ route('products.index', ['low_stock' => 1, 'sort' => 'lowest']) }}" class="bg-red-400 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-red-500 transition text-center">View Low Stock</a>
                        <a href="{{ route('suppliers.create', ['from' => 'dashboard']) }}" class="bg-green-500 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-green-600 transition text-center">+ Add New Supplier</a>
                        @role('admin')
                        <a href="{{ route('categories.create', ['from' => 'dashboard']) }}" class="bg-purple-500 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-purple-600 transition text-center">+ Add New Category</a>
                        @endrole
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-8 mb-10">
                <!-- Products Card -->
                <div class="bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col items-center">
                    <div class="text-5xl font-black text-amber-700 mb-2">{{ $productsCount ?? '--' }}</div>
                    <div class="text-lg text-amber-900 font-bold mb-2">Products</div>
                    <a href="{{ route('products.index') }}" class="text-amber-700 font-semibold hover:underline whitespace-nowrap mt-1">View Products</a>
                </div>
                <!-- Orders Card -->
                <div class="bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col items-center">
                    <div class="text-5xl font-black text-amber-700 mb-2">{{ $ordersCount ?? '--' }}</div>
                    <div class="text-lg text-amber-900 font-bold mb-2">Orders</div>
                    <a href="{{ route('orders.index') }}" class="text-amber-700 font-semibold hover:underline whitespace-nowrap mt-1">View Orders</a>
                </div>
                <!-- Sales Card -->
                <div class="bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col items-center">
                    <div class="text-5xl font-black text-amber-700 mb-2">{{ $salesCount ?? '--' }}</div>
                    <div class="text-lg text-amber-900 font-bold mb-2">Sales</div>
                    <a href="{{ route('orderitems.index') }}" class="text-amber-700 font-semibold hover:underline whitespace-nowrap mt-1">View Sales</a>
                </div>
                <!-- Stock Card -->
                <div class="bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col items-center">
                    <div class="text-5xl font-black text-amber-700 mb-2">{{ $totalStock ?? '--' }}</div>
                    <div class="text-lg text-amber-900 font-bold mb-2 whitespace-nowrap">All Products Stock</div>
                    <a href="{{ route('products.index', ['sort' => 'lowest']) }}" class="text-amber-700 font-semibold hover:underline whitespace-nowrap mt-1">Manage Stock</a>
                </div>
                <!-- Suppliers Card -->
                <div class="bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col items-center">
                    <div class="text-5xl font-black text-amber-700 mb-2">{{ $suppliersCount ?? '--' }}</div>
                    <div class="text-lg text-amber-900 font-bold mb-2">Suppliers</div>
                    <a href="{{ route('suppliers.index') }}" class="text-amber-700 font-semibold hover:underline whitespace-nowrap mt-1">View Suppliers</a>
                </div>
                <!-- Categories Card -->
                <div class="bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8 flex flex-col items-center">
                    <div class="text-5xl font-black text-amber-700 mb-2">{{ $categoriesCount ?? '--' }}</div>
                    <div class="text-lg text-amber-900 font-bold mb-2">Categories</div>
                    <a href="{{ route('categories.index') }}" class="text-amber-700 font-semibold hover:underline whitespace-nowrap mt-1">View Categories</a>
                </div>
            </div>
            <!-- Top Selling Product & Low Stock Alert -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- Top Selling Product -->
                <div class="bg-white dark:bg-gray-800 border-4 border-amber-200 rounded-2xl shadow-lg p-8 mb-8">
                    <div class="text-2xl font-bold text-amber-800 mb-4 flex items-center gap-2">
                        <span>🔥</span> Top Selling Product
                    </div>
                    @if(isset($topProduct))
                    <div class="text-lg text-amber-900 font-semibold mb-2">{{ $topProduct->name }}</div>
                    <div class="text-amber-700">Sold: <span class="font-bold">{{ $topProduct->sold_count }}</span></div>
                    <div class="text-amber-700">Stock: <span class="font-bold">{{ $topProduct->stock }}</span></div>
                    <div class="mt-4">
                        @role('admin')
                        <a href="{{ route('products.edit', $topProduct) }}" class="bg-yellow-400 text-amber-900 px-4 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition mr-2">Edit</a>
                        @endrole
                        <a href="{{ route('products.restock', $topProduct) }}" class="bg-green-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-green-500 transition">Restock</a>
                    </div>
                    @else
                    <div class="text-amber-400">No sales data available.</div>
                    @endif
                </div>
                <!-- Low Stock Alert -->
                <div class="bg-white dark:bg-gray-800 border-4 border-amber-200 rounded-2xl shadow-lg p-8 mb-8">
                    <div class="text-2xl font-bold text-amber-800 mb-4 flex items-center gap-2">
                        <span>⚠️</span> Low Stock Alert
                    </div>
                    @if(isset($lowStockProducts) && count($lowStockProducts))
                    <ul class="list-disc pl-6">
                        @foreach($lowStockProducts->take(5) as $product)
                        <li class="mb-2 text-amber-700 font-semibold flex flex-wrap items-center justify-between gap-2">
                            <span>
                                {{ $product->name }} <span class="text-red-600">({{ $product->stock }} left)</span>
                            </span>
                            <a href="{{ route('products.restock', $product) }}" class="bg-green-400 text-white px-3 py-1 rounded font-bold text-xs shadow hover:bg-green-500 transition">Restock</a>
                        </li>
                        @endforeach
                        @if($lowStockProducts->count() > 5)
                        <li class="mb-2 text-amber-400 font-bold">...</li>
                        @endif
                    </ul>
                    @if($lowStockProducts->count() > 5)
                    <div class="mt-4 text-right">
                        <a href="{{ route('products.index', ['low_stock' => 1, 'sort' => 'lowest']) }}" class="text-amber-700 font-semibold hover:underline">View All Low Stock</a>
                    </div>
                    @endif
                    @else
                    <div class="text-amber-400">No products are low on stock.</div>
                    @endif
                </div>
            </div>
            <!-- Recent Activity & Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- Recent Activity -->
                <div class="bg-white dark:bg-gray-800 border-4 border-amber-200 rounded-2xl shadow-lg p-8 mb-8">
                    <div class="text-2xl font-bold text-amber-800 mb-4 flex items-center gap-2">
                        <span>🕒</span> Recent Activity
                    </div>
                    @if(isset($recentActivities) && count($recentActivities))
                    <ul class="pl-0">
                        @foreach($recentActivities as $activity)
                        <li class="mb-2 text-amber-700 flex flex-row items-start justify-between gap-2">
                            <div class="flex-1 min-w-0 max-w-sm text-left break-words">
                                <span class="font-bold">{{ $activity->user ? $activity->user->name : 'Unknown' }}</span>:
                                {{ $activity->description }}
                            </div>
                            <span class="text-xs text-amber-500 ml-2 whitespace-nowrap mt-0.5">
                                {{ $activity->updated_at->diffForHumans() }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="text-amber-400">No recent activity.</div>
                    @endif
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-xl font-bold">
                    Welcome to your Inventory Dashboard!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>