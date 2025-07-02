<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with('orderItems.product')->latest()->paginate(15);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order and redirect to edit page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'receipt_number' => 'ORD-' . Str::upper(Str::random(12)),
            'status' => 'pending',
            'total' => 0,
        ]);

        return redirect()->route('orders.edit', $order->id);
    }

    /**
     * Show/edit an order and add items.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Add an item to the order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addItem(Request $request, $orderId)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $product = Product::findOrFail($validated['product_id']);
        $order = Order::findOrFail($orderId);

        // Check if the item already exists in the order
        $orderItem = OrderItem::where('order_id', $orderId)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($orderItem) {
            // Update quantity and subtotal
            $orderItem->quantity += $validated['quantity'];
            $orderItem->subtotal = $orderItem->quantity * $product->price;
            $orderItem->save();
        } else {
            // Create new order item
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'price' => $product->price,
                'subtotal' => $product->price * $validated['quantity'],
            ]);
        }

        //set the product status to pending again after they add a item/s
        $order->status = 'pending';
        $order->save();

        // Update order total
        $order->total = $order->orderItems()->sum('subtotal');
        $order->save();
        // Decrement product stock
        $product->decrement('stock', $validated['quantity']);
        return redirect()->route('orders.edit', $orderId)->with('success', 'Item added!');
    }

    /**
     * Remove an item from the order.
     *
     * @param  int  $orderId
     * @param  int  $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeItem($orderId, $itemId)
    {
        $item = OrderItem::findOrFail($itemId);

        // Restore stock
        $item->product->increment('stock', $item->quantity);
        $item->delete();
        // Update order total
        $order = Order::findOrFail($orderId);
        $order->total = $order->orderItems()->sum('subtotal');
        $order->save();
        return redirect()->route('orders.edit', $orderId)->with('success', 'Item removed!');
    }

    /**
     * Finalize/complete the order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order completed!');
    }
}
