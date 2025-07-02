<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-gradient-to-br from-yellow-50 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-black text-amber-800 mb-6">Order Item Details</h2>
            <div class="mb-6">
                <a href="{{ route('orderitems.index') }}" class="text-amber-700 font-semibold hover:underline">&larr; Back to Order Items</a>
            </div>
            <div class="mb-8">
                <table class="w-full text-left border-collapse">
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Product:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $orderItem->product->name ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">SKU:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $orderItem->product->sku ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Order Receipt:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $orderItem->order->receipt_number ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Quantity:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $orderItem->quantity }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Price:</th>
                        <td class="py-2 px-4 text-amber-700">₱{{ number_format($orderItem->price, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Subtotal:</th>
                        <td class="py-2 px-4 text-amber-700">₱{{ number_format($orderItem->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Date:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $orderItem->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>