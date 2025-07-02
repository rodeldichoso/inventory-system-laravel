<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-8 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-6">Restock Product</h2>
        <form action="{{ route('products.restock', $product) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Product</label>
                <input type="text" value="{{ $product->name }} (SKU: {{ $product->sku }})" class="w-full rounded px-3 py-2 bg-amber-100 text-amber-900 border border-amber-200" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Current Stock</label>
                <input type="number" value="{{ $product->stock }}" class="w-full rounded px-3 py-2 bg-amber-100 text-amber-900 border border-amber-200" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Quantity to Add</label>
                <input type="number" name="quantity" min="1" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required autofocus>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Notes <span class="text-amber-400">(optional)</span></label>
                <textarea name="notes" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" rows="2" placeholder="Reason for restock, supplier, etc."></textarea>
            </div>
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('products.index') }}" class="bg-gray-200 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-amber-700 transition">Add Stock</button>
            </div>
        </form>
    </div>
</x-app-layout>