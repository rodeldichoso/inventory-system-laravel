<x-app-layout>
    <div class="max-w-xl mx-auto mt-20 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 p-10 rounded-2xl shadow-lg border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-8">Add New Supplier</h2>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-amber-900 font-bold mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 rounded-lg border-2 border-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400" required>
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 font-bold mb-2">Contact</label>
                <input type="text" name="contact" class="w-full px-4 py-2 rounded-lg border-2 border-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div class="mb-4">
                <label class="block text-amber-900 font-bold mb-2">Address</label>
                <input type="text" name="address" class="w-full px-4 py-2 rounded-lg border-2 border-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <button type="submit" class="w-full bg-amber-600 text-white px-8 py-4 rounded-xl font-bold text-xl hover:bg-amber-700 transition mb-4">Add Supplier</button>
            <a href="{{ request('from') == 'dashboard' ? route('dashboard') : route('suppliers.index') }}" class="w-full inline-block text-center bg-gray-200 text-amber-900 px-8 py-4 rounded-xl font-bold text-xl hover:bg-gray-300 transition">Cancel</a>
        </form>
    </div>
</x-app-layout>