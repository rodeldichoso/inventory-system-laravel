<x-app-layout>
    <div class="max-w-xl mx-auto mt-16 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-10 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-8">Order Item Details</h2>
        <div class="mb-6">
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">Product:</span>
                <span class="text-amber-800">{{ $orderItem->product->name ?? 'N/A' }}</span>
            </div>
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">SKU:</span>
                <span class="text-amber-800">{{ $orderItem->product->sku ?? 'N/A' }}</span>
            </div>
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">Order Receipt:</span>
                <span class="text-amber-800">{{ $orderItem->order->receipt_number ?? 'N/A' }}</span>
            </div>
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">Quantity:</span>
                <span class="text-amber-800">{{ $orderItem->quantity }}</span>
            </div>
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">Price:</span>
                <span class="text-amber-800">₱{{ number_format($orderItem->price, 2) }}</span>
            </div>
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">Subtotal:</span>
                <span class="text-amber-800">₱{{ number_format($orderItem->subtotal, 2) }}</span>
            </div>
            <div class="mb-4 flex justify-between">
                <span class="font-bold text-amber-900">Date:</span>
                <span class="text-amber-800">{{ $orderItem->created_at->format('Y-m-d H:i') }}</span>
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('orderitems.index') }}" class="bg-gray-200 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition">Back</a>
        </div>
    </div>
</x-app-layout>