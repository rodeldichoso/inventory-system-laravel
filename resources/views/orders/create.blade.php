<x-app-layout>
    <div class="max-w-xl mx-auto mt-20 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-10 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-8">Start New Order</h2>
        <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="flex justify-end gap-4">
                <a href="{{ route('orders.index') }}" class="bg-gray-200 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="bg-amber-600 text-white px-8 py-4 rounded-xl font-bold text-xl hover:bg-amber-700 transition">Create Order</button>
            </div>
        </form>
    </div>
</x-app-layout>