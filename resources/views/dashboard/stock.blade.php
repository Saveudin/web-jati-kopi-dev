<x-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Dashboard Pergerakan Stok</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Stok Masuk -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Stok Masuk</h2>
                <p class="text-3xl font-bold text-green-600">{{ $totalIn }}</p>
            </div>

            <!-- Total Stok Keluar -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Stok Keluar</h2>
                <p class="text-3xl font-bold text-red-600">{{ $totalOut }}</p>
            </div>
        </div>

        <!-- Top 5 Bahan Baku Terpakai -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Top 5 Bahan Baku Terpakai</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Bahan Baku</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Jumlah Terpakai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($topUsedMaterials as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ $item->rawMaterial->name ?? 'Tidak diketahui' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ abs($item->total_used) }}
                            </td>
                        </tr>
                    @endforeach
                    @if ($topUsedMaterials->isEmpty())
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
