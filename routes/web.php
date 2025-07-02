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

    // Allow both admin and staff to add suppliers
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');

    // Admin-only routes for categories and suppliers (explicit)
    Route::middleware('role:admin')->group(function () {
        // Categories
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        // Suppliers (admin-only: edit, update, destroy)
        Route::get('suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
        // Products (admin-only actions)
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Resource routes (after explicit admin-only routes)
    Route::resource('products', ProductController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('orderitems', OrderItemController::class)->only(['index', 'create', 'store']);
    Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'edit']);
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'show']);

    Route::get('/products/{product}/restock', [ProductController::class, 'showRestock'])->name('products.restock');
    Route::patch('/products/{product}/restock', [ProductController::class, 'restock'])->name('products.restock.post');
    Route::post('/orders/{order}/add-item', [OrderController::class, 'addItem'])->name('orders.addItem');
    Route::get('/orderitems/{orderItem}', [OrderItemController::class, 'view'])->name('orderitems.view');
    Route::delete('/orders/{order}/remove-item/{item}', [OrderController::class, 'removeItem'])->name('orders.removeItem');
    Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
}); // CLOSE main auth/verified group

require __DIR__ . '/auth.php';
