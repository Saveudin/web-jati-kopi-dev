{{-- <h1>Halo, {{ Auth::user()->name }}</h1> --}}

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
    <section class="bg-gray-200 dark:bg-gray-900 p-3 sm:p-5 h-full space-y-4">
        <div class="p-4 bg-white text-black dark:bg-gray-800 dark:text-gray-100 rounded-xl shadow">
            <h2 class="text-lg font-bold mb-4">Sale Chart</h2>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">            
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="m-8 flex justify-between items-center mb-4">
                    <h1 class="text-black dark:text-gray-100 text-2xl font-bold">Sale Report</h1>
                    <form action="{{ route('sales.export.pdf') }}" method="GET" target="_blank">
                        <input type="date" class="text-black" id="x-date-from" name="startDate" value="{{ $startDate }}" hidden>
                        <input type="date" class="text-black" id="x-date-to" name="endDate" value="{{ $endDate }}" hidden>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl shadow hover:bg-blue-700 transition">
                            Export PDF
                        </button>
                    </form>
                </div>
                {{-- <div class="m-8 flex justify-between items-center mb-4">
                    <h1 class="text-black dark:text-gray-100 text-2xl font-bold">Sale Report</h1>
                    <a href="{{ route('sales.export.pdf') }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl shadow hover:bg-blue-700 transition">
                        Export PDF
                    </a>
                </div> --}}
                {{-- date filter --}}
                <form class="flex flex-wrap items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg mb-4" method="GET" action="{{ route('sales.report') }}">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-200">From:</label>
                    <input type="date" id="date-from" name="start_date" value="{{ $startDate }}" class="text-gray-700 dark:text-gray-200 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-200">To:</label>
                    <input type="date" id="date-to" name="end_date" value="{{ $endDate }}" class="text-gray-700 dark:text-gray-200 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow hover:bg-blue-700 transition">Filter</button>
                </form>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Date</th>
                                <th scope="col" class="px-4 py-3">Product</th>
                                <th scope="col" class="px-4 py-3">Quantity</th>
                                <th scope="col" class="px-4 py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($sales as $sale)
                            @foreach ($sale->saleItems as $item)
                            
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $item->created_at }}</td>
                                <td class="px-4 py-3">{{ $item->product->name }}</td>
                                <td class="px-4 py-3">{{ $item->quantity }}</td>
                                <td class="px-4 py-3">{{ $item->quantity * $item->subtotal }}</td>
                            </tr>
                            @endforeach
                            {{-- Foreach table end --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    {{ $sales->links() }}
                </nav>
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
<script>
    document.addEventListener('')
</script>