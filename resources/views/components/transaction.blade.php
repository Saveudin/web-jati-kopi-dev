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
    <section class="bg-gray-200 dark:bg-gray-900 p-3 sm:p-5 h-full">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        {{-- Toggle Modal --}}
                        <div class="flex justify-center m-5">
                            <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                            Create transaction
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">ID</th>
                                <th scope="col" class="px-4 py-3">Items</th>
                                <th scope="col" class="px-4 py-3">Total</th>
                                <th scope="col" class="px-4 py-3">Transaction Date</th>
                                <th scope="col" class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                            @endphp
                        @foreach ($sales as $sale)
                        <tbody>

                            {{-- Foreach table --}}
                            
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $i }}</td>
                                <td class="px-4 py-3">{{ $sale->id }}</td>
                                <td class="px-4 py-3">
                                    @foreach($sale->saleItems as $item)
                                        @if($item->sale_id == $sale->id)
                                        <div>
                                            {{ $item->product->name }} x {{ $item->quantity }} = Rp{{ number_format($item->quantity * $item->subtotal) }}
                                        </div>
                                        @endif
                                    @endforeach
                                </td>                                
                                <td class="px-4 py-3">{{ $sale->total }}</td>
                                <td class="px-4 py-3">{{ $sale->created_at }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('transactions.print', ['id' => $item->sale_id]) }}" target="_blank"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Print Bill
                                    </a>

                                </td>
                            </tr>
                            {{-- Foreach table end --}}
                        </tbody>
                        @php
                        $i += 1;
                        @endphp
                        @endforeach
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    {{ $sales->links() }}
                </nav>
            </div>
        </div>
        </section>

<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Transaction
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            
            <form method="POST" action="{{ route('sale.post') }}">
                @csrf
            <div class="max-h-96 overflow-y-scroll">
                <div id="items">
                    <div class="item-row">
                        <select name="product_ids[]" class="product-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - Rp{{ number_format($product->price) }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" class="quantity-input mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Qty" min="1" required>
                        <input type="text" class="subtotal mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Subtotal" readonly>
                        <button type="button" class="remove-row mt-2 text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Remove product</button>
                    </div>
                </div>
            </div>
                <button type="button" id="add-row" class=" mt-2 inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">+ Tambah Produk</button>
            
                <p class="my-2"><strong class="text-black dark:text-white">Total: Rp <span id="total-price">0</span></strong></p>
            
                <button type="submit" class="text-white inline-flex items-end bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Simpan Transaksi</button>
            </form>
            
        </div>
    </div>
</div>
{{-- main modal end --}}

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
