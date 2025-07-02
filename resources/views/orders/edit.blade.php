<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 sm:mt-16 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-4 sm:p-10 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-2xl sm:text-3xl font-bold text-amber-900 mb-6 sm:mb-8">Edit Order #{{ $order->id }}</h2>
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 sm:gap-4">
                <div>
                    <span class="font-bold text-amber-900">Status:</span> <span class="text-amber-700">{{ ucfirst($order->status) }}</span>
                </div>
                <div>
                    <span class="font-bold text-amber-900">Total:</span> <span class="text-amber-800 font-bold">₱{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>
        <div class="mb-8 sm:mb-10">
            <h3 class="text-lg sm:text-xl font-bold text-amber-900 mb-3 sm:mb-4">Add Product to Order</h3>
            <form action="{{ route('orders.addItem', $order->id) }}" method="POST" class="flex flex-col md:flex-row gap-2 sm:gap-4 items-stretch md:items-end">
                @csrf
                <div class="flex-1">
                    <label class="block text-amber-900 mb-1">Product</label>
                    <select name="product_id" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200" required>
                        <option value="">Select product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-amber-900 mb-1">Quantity</label>
                    <input type="number" name="quantity" min="1" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200" required>
                </div>
                <button type="submit" class="bg-amber-600 text-white px-4 sm:px-6 py-2 rounded-lg font-bold hover:bg-amber-700 transition w-full md:w-auto">Add Item</button>
            </form>
        </div>
        <div>
            <h3 class="text-lg sm:text-xl font-bold text-amber-900 mb-3 sm:mb-4">Order Items</h3>
            <div class="overflow-x-auto rounded-xl">
                <table class="min-w-full bg-amber-50 border-2 border-amber-200 rounded-2xl shadow-xl mb-4 sm:mb-6 text-xs sm:text-lg">
                    <thead>
                        <tr class="bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-100 text-amber-900">
                            <th class="border-b-4 border-amber-300 px-2 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-lg">Product</th>
                            <th class="border-b-4 border-amber-300 px-2 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-lg">Quantity</th>
                            <th class="border-b-4 border-amber-300 px-2 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-lg">Price</th>
                            <th class="border-b-4 border-amber-300 px-2 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-lg">Subtotal</th>
                            <th class="border-b-4 border-amber-300 px-2 sm:px-6 py-2 sm:py-4 text-right text-xs sm:text-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->orderItems as $item)
                        <tr class="hover:bg-gradient-to-r hover:from-amber-100 hover:via-yellow-50 hover:to-amber-50 transition-all duration-200">
                            <td class="border-b border-amber-100 px-2 sm:px-6 py-2 sm:py-4 text-amber-900 font-semibold text-xs sm:text-lg">{{ $item->product->name ?? 'N/A' }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-6 py-2 sm:py-4 text-amber-700 text-xs sm:text-lg">{{ $item->quantity }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-6 py-2 sm:py-4 text-amber-800 font-bold text-xs sm:text-lg">₱{{ number_format($item->price, 2) }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-6 py-2 sm:py-4 text-amber-700 font-bold text-xs sm:text-lg">₱{{ number_format($item->subtotal, 2) }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-6 py-2 sm:py-4 flex flex-col sm:flex-row gap-2 justify-end items-stretch sm:items-center text-xs sm:text-lg">
                                <form action="{{ route('orders.removeItem', [$order->id, $item->id]) }}" method="POST" onsubmit="return confirm('Remove this item?');" class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-200 text-red-900 px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:bg-red-300 transition w-full sm:w-auto">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-amber-400 text-lg sm:text-xl py-6 sm:py-10">No items in this order.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-4 mt-6 sm:mt-8">
            <a href="{{ route('orders.index') }}" class="bg-gray-200 text-amber-900 px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition w-full sm:w-auto text-center">Cancel</a>
            <form action="{{ route('orders.complete', $order->id) }}" method="POST" class="inline w-full sm:w-auto">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-bold shadow hover:bg-green-700 transition w-full sm:w-auto">Complete Order</button>
            </form>
        </div>
    </div>
</x-app-layout>