<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the order items (sales history).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orderItems = OrderItem::with('product')->latest()->paginate(20);
        return view('orderItems.index', compact('orderItems'));
    }

    /**
     * Show the form for creating a new order item (sale).
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        $orders = Order::all();
        return view('orderItems.create', compact('products', 'orders'));
    }

    /**
     * Store a newly created order item (sale) in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $validated['product_id'] = $product->id;
        $validated['price'] = $product->price;
        $validated['subtotal'] = $product->price * $validated['quantity'];

        if ($product->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough stock available.']);
        }

        // Create the order item (sale)
        OrderItem::create($validated);

        // Decrease product stock
        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('orderitems.index')->with('success', 'Sale recorded successfully!');
    }

    /**
     * Display the specified order item.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\View\View
     */
    public function view(OrderItem $orderItem)
    {
        return view('orderItems.view', compact('orderItem'));
    }
}
