<x-app-layout>
    <div class="container mx-auto p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 rounded-3xl shadow-2xl mt-12 border-4 border-amber-200">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-black text-amber-900 drop-shadow-lg tracking-tight">Sales History</h2>
            <a href="{{ route('orderitems.create') }}" class="bg-amber-600 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition text-lg">+ Record New Sale</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-amber-50 border-2 border-amber-200 rounded-2xl shadow-xl table-fixed text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-100 text-amber-900">
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-12">#</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-40">Order Receipt</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-48">Product</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-32">Sku</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-24">Quantity</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-28">Price</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-32">Subtotal</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-40">Date</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-center text-sm w-32">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orderItems as $item)
                    <tr class="hover:bg-gradient-to-r hover:from-amber-100 hover:via-yellow-50 hover:to-amber-50 transition-all duration-200">
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700 text-center text-sm">{{ $loop->iteration }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700 text-center text-sm">{{ $item->order->receipt_number ?? 'N/A' }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-900 font-semibold text-center text-sm">{{ $item->product->name ?? 'N/A' }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700 text-center text-sm">{{ $item->product->sku ?? 'N/A' }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700 text-center text-sm">{{ $item->quantity }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-800 font-bold text-center text-sm">${{ number_format($item->price, 2) }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700 font-bold text-center text-sm">${{ number_format($item->subtotal, 2) }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700 text-center text-sm">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 flex gap-2 justify-center text-sm">
                            <a href="{{ route('orderitems.view', $item) }}" class="bg-amber-400 text-amber-900 px-4 py-2 rounded-lg font-bold shadow hover:bg-amber-500 transition text-sm">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-amber-400 text-xl py-20">No sales recorded.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $orderItems->links() }}
        </div>
    </div>
</x-app-layout>