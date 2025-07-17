<x-app-layout>
    <div class="container mx-auto p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 rounded-3xl shadow-2xl mt-12 border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-8">Suppliers</h2>

        <!-- Show success message if a supplier was created, edited, or deleted -->
        @if(session('success'))
        <div id="success-alert" class="mb-6 p-4 bg-gradient-to-r from-amber-200 via-amber-100 to-amber-50 border-2 border-amber-400 text-amber-900 rounded-xl font-bold text-lg shadow flex items-center gap-2">
            <span class="text-xl">✔️</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        <a href="{{ route('suppliers.create') }}" class="bg-amber-600 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition text-lg mb-6 inline-block">+ Add New Supplier</a>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-amber-50 border-2 border-amber-200 rounded-2xl shadow-xl mt-4">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-100 text-amber-900">
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg">#</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg">Name</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg">Contact</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg">Email</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg">Address</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-right text-lg">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $key => $supplier)
                    <tr class="hover:bg-gradient-to-r hover:from-amber-100 hover:via-yellow-50 hover:to-amber-50 transition-all duration-200">
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700">{{ $key + 1 }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-900 font-semibold">{{ $supplier->name }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700">{{ $supplier->contact }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700">{{ $supplier->email }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700">{{ $supplier->address }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 flex gap-4 justify-end">
                            <a href="{{ route('suppliers.show', $supplier->id) }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-blue-500 transition">View</a>
                            @role('admin')
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-yellow-400 text-amber-900 px-4 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition">Edit</a>
                            @endrole
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-amber-400 text-xl py-20">No suppliers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) alert.style.display = 'none';
        }, 3000);
    </script>
</x-app-layout>