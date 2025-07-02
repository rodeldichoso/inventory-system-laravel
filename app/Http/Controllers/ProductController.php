<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
        if ($product = Product::create($validated)) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'create',
                'subject_type' => Product::class,
                'subject_id' => $product->id,
                'description' => 'Added new product ' . $validated['name'] . ' with SKU: ' . $validated['sku'],
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'nullable|string',
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Show the form for restocking a product.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function showRestock(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.restock', compact('product'));
    }

    /**
     * Restock the specified product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restock(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        if ($product->increment('stock', $validated['quantity'])) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'restock',
                'subject_type' => Product::class,
                'subject_id' => $product->id,
                'description' => 'Restocked product: ' . $product->name . ' by ' . $validated['quantity'] . ' units. Notes: ' . $validated['notes'],
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product restocked successfully!');
    }
}
