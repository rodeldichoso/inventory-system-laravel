<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderItemController;

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('orderitems', OrderItemController::class)->only(['index', 'create', 'store']);
    Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'edit']);
    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store', 'edit', 'destroy']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);

    Route::get('/products/{product}/restock', [ProductController::class, 'showRestock'])->name('products.restock');
    Route::patch('/products/{product}/restock', [ProductController::class, 'restock'])->name('products.restock.post');

    Route::post('/orders/{order}/add-item', [OrderController::class, 'addItem'])->name('orders.addItem');
    Route::get('/orderitems/{orderItem}', [OrderItemController::class, 'view'])->name('orderitems.view');
    Route::delete('/orders/{order}/remove-item/{item}', [OrderController::class, 'removeItem'])->name('orders.removeItem');
    Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
});

require __DIR__ . '/auth.php';
