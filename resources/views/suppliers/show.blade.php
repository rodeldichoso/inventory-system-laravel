<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-gradient-to-br from-yellow-50 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-black text-amber-800 mb-6">Supplier Details</h2>
            <div class="mb-6">
                <a href="{{ route('suppliers.index') }}" class="text-amber-700 font-semibold hover:underline">&larr; Back to Supplier List</a>
            </div>
            <div class="mb-8">
                <table class="w-full text-left border-collapse">
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Name:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $supplier->name }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Contact:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $supplier->contact ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Email:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $supplier->email ?? '--' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Address:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $supplier->address ?? '--' }}</td>
                    </tr>
                </table>
            </div>
            <div class="flex gap-4">
                @role('admin|staff')
                <a href="{{ route('suppliers.create') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg font-bold shadow hover:bg-green-600 transition">+ Add Supplier</a>
                @endrole
                @role('admin')
                <a href="{{ route('suppliers.edit', $supplier) }}" class="bg-yellow-400 text-amber-900 px-6 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition">Edit</a>
                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this supplier?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-200 text-red-900 px-6 py-2 rounded-lg font-bold shadow hover:bg-red-300 transition">Delete</button>
                </form>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>