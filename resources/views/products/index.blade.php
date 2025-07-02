<x-app-layout>
    @php $showLowStockOnly = request('low_stock') == 1; @endphp
    <div class="container mx-auto p-4 sm:p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 rounded-3xl shadow-2xl mt-6 sm:mt-12 border-4 border-amber-200">
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mb-6 sm:mb-10 gap-4 sm:gap-0">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-6">
                <h2 class="text-3xl sm:text-5xl font-black text-amber-800 drop-shadow-lg tracking-tight">
                    @if($showLowStockOnly)
                    Low Stock Product List
                    @else
                    Product List
                    @endif
                </h2>
                <select id="sort-stock" class="px-4 sm:px-6 py-2 rounded-lg border-amber-200 border text-base sm:text-lg min-w-[120px] sm:min-w-[140px] appearance-none bg-amber-50 text-amber-900 pr-8 sm:pr-10 mt-2 sm:mt-0 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 w-full sm:w-auto">
                    <option value="">Sort By Stock</option>
                    <option value="asc">Lowest</option>
                    <option value="desc">Highest</option>
                </select>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-stretch sm:items-center w-full sm:w-auto">
                <input id="product-search" type="text" placeholder="Search by name, SKU, Category or supplier..." class="w-full sm:w-96 px-4 py-2 rounded border border-amber-200 focus:ring-2 focus:ring-amber-400 text-base sm:text-lg bg-amber-50 text-amber-900 placeholder-amber-500" />
                <a href="{{ route('products.create') }}" class="bg-amber-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-bold shadow hover:bg-amber-700 transition text-base sm:text-lg text-center">+ Add New Product</a>
            </div>
        </div>
        <!-- Success message -->
        @if(session('success'))
        <div id="success-alert" class="mb-4 sm:mb-6 p-3 sm:p-4 bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-50 border-2 border-amber-400 text-amber-900 rounded-xl font-bold text-base sm:text-lg shadow flex items-center gap-2">
            <span class="text-lg sm:text-xl">✔️</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        <div class="overflow-x-auto rounded-xl">
            <table id="products-table" class="min-w-full bg-amber-50 border-2 border-amber-200 rounded-2xl shadow-xl table-fixed text-xs sm:text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-200 via-yellow-100 to-amber-100 text-amber-900">
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-8 sm:w-12">#</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-32 sm:w-48">Name</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-20 sm:w-32 hidden xs:table-cell">SKU</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-16 sm:w-28">Price</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-14 sm:w-24">Stock</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-24 sm:w-40 hidden md:table-cell">Category</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-24 sm:w-40 hidden md:table-cell">Supplier</th>
                        <th class="border-b-4 border-amber-300 px-2 sm:px-8 py-3 sm:py-5 text-center text-xs sm:text-sm w-24 sm:w-40">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $filteredProducts = $showLowStockOnly ? $products->filter(fn($p) => $p->stock < 20) : $products; @endphp
                        @forelse ($filteredProducts as $product)
                        @php $isLowStock=$product->stock < 20; @endphp
                            <tr class="hover:bg-gradient-to-r hover:from-amber-100 hover:via-yellow-50 hover:to-amber-50 transition-all duration-200">
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }}">{{ $loop->iteration }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-900 font-semibold text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }}">{{ $product->name }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }} hidden xs:table-cell">{{ $product->sku }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-800 font-bold text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }}">₱{{ number_format($product->price, 2) }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 font-bold text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100 text-amber-900' : 'text-amber-700' }}">{{ $product->stock }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }} hidden md:table-cell">{{ $product->category->name ?? '--' }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 text-amber-700 text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }} hidden md:table-cell">{{ $product->supplier->name ?? '--' }}</td>
                            <td class="border-b border-amber-100 px-2 sm:px-8 py-3 sm:py-5 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center items-center text-center text-xs sm:text-sm whitespace-nowrap {{ $isLowStock ? 'bg-red-100' : '' }}">
                                @role('admin')
                                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-400 text-amber-900 px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:bg-yellow-500 transition w-full sm:w-auto">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline w-full sm:w-auto" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-200 text-red-900 px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:bg-red-300 transition w-full sm:w-auto">Delete</button>
                                </form>
                                @endrole
                                <a href="{{ route('products.restock', $product) }}" class="bg-green-400 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:bg-green-500 transition w-full sm:w-auto">Restock</a>
                            </td>
                            </tr>
                            @empty
                            <tr id="no-products-row">
                                <td colspan="8" class="text-center text-amber-400 text-lg sm:text-xl py-10 sm:py-20">
                                    @if($showLowStockOnly)
                                    No low stock products found yet.
                                    @else
                                    No products found.
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                            <tr id="no-match-row" style="display:none;">
                                <td colspan="8" class="text-center text-amber-400 text-lg sm:text-xl py-10 sm:py-20">
                                    No products match your search.
                                </td>
                            </tr>
                </tbody>
            </table>
        </div>
        <style>
            @media (max-width: 640px) {

                /* Hide SKU on xs, show on sm */
                .xs\:table-cell {
                    display: none !important;
                }
            }

            @media (min-width: 640px) {
                .xs\:table-cell {
                    display: table-cell !important;
                }
            }

            @media (max-width: 768px) {

                /* Hide Category/Supplier on md, show on lg */
                .md\:table-cell {
                    display: none !important;
                }
            }

            @media (min-width: 768px) {
                .md\:table-cell {
                    display: table-cell !important;
                }
            }
        </style>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product-search');
            const table = document.getElementById('products-table');
            const sortSelect = document.getElementById('sort-stock');
            const tbody = table.querySelector('tbody');
            // Store original order
            const originalRows = Array.from(tbody.querySelectorAll('tr'));

            // Auto-select 'Lowest' if sort=lowest is in the URL (run after DOM is ready)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('sort') === 'lowest') {
                setTimeout(function() {
                    sortSelect.value = 'asc';
                    sortSelect.dispatchEvent(new Event('change'));
                }, 0);
            }

            searchInput.addEventListener('input', function() {
                const filter = searchInput.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');
                let visibleCount = 0;
                rows.forEach(row => {
                    // skip the no-match and no-products rows
                    if (row.id === 'no-match-row' || row.id === 'no-products-row') return;
                    const name = row.children[1]?.textContent.toLowerCase() || '';
                    const sku = row.children[2]?.textContent.toLowerCase() || '';
                    const supplier = row.children[6]?.textContent.toLowerCase() || '';
                    const category = row.children[5]?.textContent.toLowerCase() || '';
                    if (name.includes(filter) || sku.includes(filter) || supplier.includes(filter) || category.includes(filter)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                // Show/hide the no-match row
                const noMatchRow = document.getElementById('no-match-row');
                const noProductsRow = document.getElementById('no-products-row');
                if (filter && visibleCount === 0) {
                    if (noMatchRow) noMatchRow.style.display = '';
                    if (noProductsRow) noProductsRow.style.display = 'none';
                } else {
                    if (noMatchRow) noMatchRow.style.display = 'none';
                    if (noProductsRow && visibleCount === 0 && !filter) noProductsRow.style.display = '';
                }
            });
            sortSelect.addEventListener('change', function() {
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const direction = sortSelect.value;
                if (!direction) {
                    // Restore original order
                    originalRows.forEach(row => tbody.appendChild(row));
                    return;
                }
                rows.sort((a, b) => {
                    const stockA = parseInt(a.children[4]?.textContent) || 0;
                    const stockB = parseInt(b.children[4]?.textContent) || 0;
                    return direction === 'asc' ? stockA - stockB : stockB - stockA;
                });
                rows.forEach(row => tbody.appendChild(row));
            });
            // Auto-hide success alert
            setTimeout(function() {
                const alert = document.getElementById('success-alert');
                if (alert) alert.style.display = 'none';
            }, 3000);
        });
    </script>
</x-app-layout>