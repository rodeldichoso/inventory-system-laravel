<x-app-layout>
    <div class="container mx-auto p-4 sm:p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 rounded-3xl shadow-2xl mt-6 sm:mt-12 border-4 border-amber-200">
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mb-6 sm:mb-10 gap-4 sm:gap-0">
            <h2 class="text-2xl sm:text-4xl font-black text-amber-900 drop-shadow-lg tracking-tight">Orders</h2>
            <a href="{{ route('orders.create') }}" class="bg-amber-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition text-base sm:text-lg text-center w-full sm:w-auto">+ New Order</a>
        </div>
        <div class="overflow-x-auto rounded-xl">
            <table class="min-w-full bg-amber-50 border-2 border-amber-200 rounded-2xl shadow-xl text-xs sm:text-lg">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-100 text-amber-900">
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-left text-xs sm:text-lg w-8 sm:w-auto">#</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-left text-xs sm:text-lg w-24 sm:w-auto">Order Receipt</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-left text-xs sm:text-lg w-24 sm:w-auto">Date</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-left text-xs sm:text-lg w-20 sm:w-auto">Status</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-left text-xs sm:text-lg w-20 sm:w-auto">Total</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-left text-xs sm:text-lg w-16 sm:w-auto">Items</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-right text-xs sm:text-lg w-24 sm:w-auto">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr class="hover:bg-gradient-to-r hover:from-amber-100 hover:via-yellow-50 hover:to-amber-50 transition-all duration-200">
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-900 font-semibold text-xs sm:text-lg">{{ $loop->iteration }}</td>
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-900 font-semibold text-xs sm:text-lg">{{ $order->receipt_number }}</td>
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-xs sm:text-lg">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-xs sm:text-lg">{{ ucfirst($order->status) }}</td>
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-800 font-bold text-xs sm:text-lg">₱{{ number_format($order->total, 2) }}</td>
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-xs sm:text-lg">{{ $order->orderItems->count() }}</td>
                        <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 flex flex-col sm:flex-row gap-2 justify-end items-stretch sm:items-center text-xs sm:text-lg">
                            <a href="{{ route('orders.edit', $order->id) }}" class="bg-amber-400 text-amber-900 px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:bg-amber-500 transition w-full sm:w-auto text-center">View/Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-amber-400 text-lg sm:text-xl py-10 sm:py-20">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 sm:mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>