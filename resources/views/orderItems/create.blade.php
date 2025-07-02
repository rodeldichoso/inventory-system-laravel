<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-8 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-6">Record Sale</h2>
        <form action="{{ route('orderitems.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Product</label>
                <select name="product_id" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200" required>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Order (optional)</label>
                <select name="order_id" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200">
                    <option value="">No Order</option>
                    @foreach($orders as $order)
                    <option value="{{ $order->id }}">Order #{{ $order->id }} - {{ $order->created_at->format('Y-m-d') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Quantity Sold</label>
                <input type="number" name="quantity" min="1" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200" required>
            </div>
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ request('from') == 'dashboard' ? route('dashboard') : route('orderitems.index') }}" class="bg-gray-200 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-amber-700 transition">Record Sale</button>
            </div>
        </form>
    </div>
</x-app-layout>