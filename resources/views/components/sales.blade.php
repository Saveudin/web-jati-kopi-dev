{{-- <div class="container">
    <h2>Laporan Penjualan</h2>

    <form method="GET" action="{{ route('sales.report') }}">
        <label>Dari:</label>
        <input type="date" name="start_date" value="{{ $startDate }}">
        <label>Sampai:</label>
        <input type="date" name="end_date" value="{{ $endDate }}">
        <button type="submit">Filter</button>
    </form>

    <h4>Total Pendapatan: Rp {{ number_format($totalRevenue) }}</h4>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                @foreach ($sale->saleItems as $item)
                <tr>
                    <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                    <td>{{ $item->product->name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->subtotal) }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-layout>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">An error occurred</strong>
            <span class="block sm:inline">Something seriously bad happened.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        
    @endif
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 h-auto space-y-4">
        <div class="p-4 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-xl shadow">
            <h2 class="text-lg font-bold mb-4">Sale Chart</h2>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Sale Report</h1>
                <a href="{{ route('sales.export.pdf') }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl shadow hover:bg-blue-700 transition">
                    Export PDF
                </a>
            </div>
            
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Tanggal</th>
                                <th scope="col" class="px-4 py-3">Product</th>
                                <th scope="col" class="px-4 py-3">Quantity</th>
                                <th scope="col" class="px-4 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($sales as $sale)
                            @foreach ($sale->saleItems as $item)
                            
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $item->created_at }}</td>
                                <td class="px-4 py-3">{{ $item->product->name }}</td>
                                <td class="px-4 py-3">{{ $item->quantity }}</td>
                                <td class="px-4 py-3">{{ $item->subtotal }}</td>
                            </tr>
                            @endforeach
                            {{-- Foreach table end --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
        </section>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('defaultModalButton').click();
    document.getElementById('updateProductButton').click();
});
// document.addEventListener("DOMContentLoaded", function () {
        const updateButtons = document.querySelectorAll("#updateProductButton");
        const modal = document.getElementById("updateProductModal");

        updateButtons.forEach(button => {
            button.addEventListener("click", function () {
                // Ambil data dari atribut tombol
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");
                const price = this.getAttribute("data-price");
                const stock = this.getAttribute("data-stock");
                const unit = this.getAttribute("data-unit");

                // Isi input modal dengan data
                document.getElementById("update-id").value = id;
                document.getElementById("update-name").value = name;
                document.getElementById("update-price").value = price;
                document.getElementById("update-stock").value = stock;
                document.getElementById("update-unit").value = unit;
            });
        });
</script>
</x-layout>

<script>
document.getElementById('add-row').addEventListener('click', function () {
    const row = document.querySelector('.item-row').cloneNode(true);
    row.querySelector('.quantity-input').value = '';
    row.querySelector('.subtotal').value = '';
    document.getElementById('items').appendChild(row);
});

document.addEventListener('input', function (e) {
    if (e.target.classList.contains('quantity-input') || e.target.classList.contains('product-select')) {
        updateSubtotals();
    }
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.parentElement.remove();
        updateSubtotals();
    }
});

function updateSubtotals() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const select = row.querySelector('.product-select');
        const qty = parseFloat(row.querySelector('.quantity-input').value) || 0;
        const price = parseFloat(select.options[select.selectedIndex].dataset.price) || 0;
        const subtotal = qty * price;
        row.querySelector('.subtotal').value = subtotal.toLocaleString();
        total += subtotal;
    });
    document.getElementById('total-price').textContent = total.toLocaleString();
}
</script>
<script>
    const labels = {!! json_encode($sales->pluck('created_at')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M Y'))) !!};
    const data = {!! json_encode($sales->pluck('total')) !!};

    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sale Total',
                data: data,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
