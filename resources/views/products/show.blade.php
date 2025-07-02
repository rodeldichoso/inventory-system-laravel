<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-gradient-to-br from-yellow-50 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-black text-amber-800 mb-6">Product Details</h2>
            <div class="mb-6">
                <a href="{{ route('products.index') }}" class="text-amber-700 font-semibold hover:underline">&larr; Back to Product List</a>
            </div>
            <div class="mb-8">
                <table class="w-full text-left border-collapse">
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Name:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Category:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $product->category->name ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Supplier:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $product->supplier->name ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Price:</th>
                        <td class="py-2 px-4 text-amber-700">₱{{ number_format($product->price, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Stock:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Description:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $product->description ?? '--' }}</td>
                    </tr>
                </table>
            </div>
            @role('admin')
            <a href="{{ route('products.edit', $product) }}" class="bg-yellow-400 text-amber-900 px-6 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-200 text-red-900 px-6 py-2 rounded-lg font-bold shadow hover:bg-red-300 transition">Delete</button>
            </form>
            @endrole
        </div>
    </div>
    </div>
</x-app-layout>