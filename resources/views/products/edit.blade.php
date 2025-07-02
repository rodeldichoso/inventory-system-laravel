<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-8 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-6">Edit Product</h2>
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Category</label>
                <select name="category_id" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-amber-900 mb-1">Supplier</label>
                <select name="supplier_id" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" required>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if(old('supplier_id', $product->supplier_id) == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 mb-1">Description</label>
                <textarea name="description" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400" rows="3" placeholder="Optional">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('products.index') }}" class="bg-gray-200 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-amber-700 transition">Update Product</button>
            </div>
        </form>
    </div>
</x-app-layout>