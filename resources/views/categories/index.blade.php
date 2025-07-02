<x-app-layout>
    <div class="container mx-auto p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 rounded-3xl shadow-2xl mt-12 border-4 border-amber-200">
        <h2 class="text-3xl font-bold text-amber-900 mb-8">Categories</h2>

        <!-- Success message -->
        @if(session('success'))
        <div id="success-alert" class="mb-6 p-4 bg-gradient-to-r from-amber-200 via-amber-100 to-amber-50 border-2 border-amber-400 text-amber-900 rounded-xl font-bold text-lg shadow flex items-center gap-2">
            <span class="text-xl">✔️</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @role('admin')
        <a href="{{ route('categories.create') }}" class="bg-amber-600 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition text-lg mb-6 inline-block">+ Add New Category</a>
        @endrole
        <div class="overflow-x-auto">
            <table class="min-w-full bg-amber-50 border-2 border-amber-200 rounded-2xl shadow-xl mt-4 table-fixed">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-100 text-amber-900">
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg w-12">#</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg w-64">Name</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg w-48">Added By</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-left text-lg w-48">Created At</th>
                        <th class="border-b-4 border-amber-300 px-8 py-5 text-right text-lg w-40">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $category)
                    <tr class="hover:bg-gradient-to-r hover:from-amber-100 hover:via-yellow-50 hover:to-amber-50 transition-all duration-200">
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700">{{ $key + 1 }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-900 font-semibold">{{ $category->name }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-900 font-semibold">{{ $category->creator->name ?? 'N/A' }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 text-amber-700">{{ $category->created_at->format('Y-m-d H:i') }}</td>
                        <td class="border-b border-amber-100 px-8 py-5 flex gap-4 justify-end">
                            <a href="{{ route('categories.show', $category->id) }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-blue-500 transition">View</a>
                            @role('admin')
                            <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-400 text-amber-900 px-4 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-200 text-red-900 px-4 py-2 rounded-lg font-bold shadow hover:bg-red-300 transition">Delete</button>
                            </form>
                            @endrole
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-amber-400 text-xl py-20">No categories found.</td>
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