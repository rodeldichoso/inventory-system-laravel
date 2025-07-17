<x-app-layout>
    <div class="container mx-auto p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 rounded-3xl shadow-2xl mt-12 border-4 border-amber-200 max-w-xl">
        <h2 class="text-3xl font-bold text-amber-900 mb-8">Add New Category</h2>

        @if ($errors->any())
        <div class="mb-4 p-2 bg-red-100 border-2 border-red-400 text-red-900 rounded-xl font-bold text-lg shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-lg font-semibold text-amber-900 mb-2">Category Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-lg border-2 border-amber-300 focus:border-amber-500 focus:ring-amber-200 focus:ring-2 outline-none text-amber-900 text-lg" placeholder="Enter category name" required value="{{ old('name') }}">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-lg font-semibold text-amber-900 mb-2">Description (optional)</label>
                <textarea name="description" id="description" class="w-full px-4 py-3 rounded-lg border-2 border-amber-300 focus:border-amber-500 focus:ring-amber-200 focus:ring-2 outline-none text-amber-900 text-lg" placeholder="Enter category description">{{ old('description') }}</textarea>
                <div class="flex justify-end gap-4">
                    <a href="{{ request('from') == 'dashboard' ? route('dashboard') : route('categories.index') }}" class="bg-gray-200 text-amber-900 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-300 transition">Cancel</a>
                    <button type="submit" class="bg-amber-600 text-white px-6 py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition">Add Category</button>
                </div>
        </form>
    </div>
</x-app-layout>