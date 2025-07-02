<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-gradient-to-br from-yellow-50 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-black text-amber-800 mb-6">Category Details</h2>
            <div class="mb-6">
                <a href="{{ route('categories.index') }}" class="text-amber-700 font-semibold hover:underline">&larr; Back to Category List</a>
            </div>
            <div class="mb-8">
                <table class="w-full text-left border-collapse">
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Name:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 text-amber-900">Description:</th>
                        <td class="py-2 px-4 text-amber-700">{{ $category->description ?? '--' }}</td>
                    </tr>
                </table>
            </div>
            <div class="flex gap-4">
                @role('admin')
                <a href="{{ route('categories.edit', $category) }}" class="bg-yellow-400 text-amber-900 px-6 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition">Edit</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-200 text-red-900 px-6 py-2 rounded-lg font-bold shadow hover:bg-red-300 transition">Delete</button>
                </form>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>