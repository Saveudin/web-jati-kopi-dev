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
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex justify-end p-4">
                    <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="cursor-pointer text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">Create recipe</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Product Name</th>
                                <th class="px-4 py-3">Material</th>
                                <th class="px-4 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @if ($product->recipes->isEmpty())
                                    @continue
                                @endif
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $product->id }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                                <td class="px-4 py-3">
                                    @if ($product->recipes->count())
                                        {{ $product->recipes->map(fn($r) => $r->rawMaterial ? "{$r->rawMaterial->name} ({$r->quantity} {$r->unit})" : null)->filter()->implode(', ') }}
                                    @else
                                        <span class="text-red-500">No materials found</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button type="button" data-modal-target="updateModal-{{ $product->id }}" data-modal-toggle="updateModal-{{ $product->id }}" class="cursor-pointer text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5">Update recipe</button>
                                </td>
                            </tr>

                            <div id="updateModal-{{ $product->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-2xl">
                                    <div class="flex justify-between items-center border-b pb-3 mb-4">
                                        <h3 class="text-lg font-semibold">Update Recipe</h3>
                                        <button data-modal-toggle="updateModal-{{ $product->id }}" class="cursor-pointer text-gray-500 hover:text-gray-900">×</button>
                                    </div>
                                    <form action="{{ route('recipe.update', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4">
                                            <input type="text" value="{{ $product->id }}" name="product_id" hidden class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" />
                                            <input type="text" value="{{ $product->name }}" name="product_name" disabled class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" />
                                            <div id="ingredients-{{ $product->id }}" class="max-h-64 overflow-y-auto">
                                                @foreach ($product->recipes as $recipe)
                                                <input type="hidden" name="recipe_id[]" value="{{ $recipe->id }}">
                                                    <div class="ingredient-row mb-4">
                                                        <select name="raw_material_id[]" class="w-full mb-2 mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            @foreach ($materials as $material)
                                                                <option value="{{ $material->id }}" {{ $material->id == $recipe->raw_material_id ? 'selected' : '' }}>{{ $material->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input name="quantity[]" value="{{ $recipe->quantity }}" class="w-full mb-2 mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" step="0.01" required />
                                                        <select name="unit[]" class="w-full mb-2 mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option value="gram" {{ $recipe->unit == 'gram' ? 'selected' : '' }}>gram</option>
                                                            <option value="mililiter" {{ $recipe->unit == 'mililiter' ? 'selected' : '' }}>mililiter</option>
                                                        </select>
                                                        <button type="button" class="cursor-pointer cursor-pointer remove-row text-red-500 mt-1">Remove</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="cursor-pointer add-row text-blue-500" data-target="ingredients-{{ $product->id }}">+ Add Ingredient</button>
                                            <div class="flex space-x-2 mt-4">
                                                <button type="submit" class="cursor-pointer bg-primary-700 text-white px-4 py-2 rounded">Update</button>
                                    </form>
                                    <form action="{{ route('recipe.delete', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cursor-pointer text-red-600 border border-red-600 px-4 py-2 rounded">Delete</button>
                                    </form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<script>
    document.addEventListener('click', function(e) {
    if (e.target.classList.contains('add-row')) {
        const targetId = e.target.dataset.target;
        const container = document.getElementById(targetId);
        const firstRow = container.querySelector('.ingredient-row');

        if (firstRow) {
            const newRow = firstRow.cloneNode(true);

            // Kosongkan input dan select
            newRow.querySelectorAll('input').forEach(input => {
                if (input.name !== 'recipe_id') input.value = '';
            });
            newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

            container.appendChild(newRow);
        }
    }

    if (e.target.classList.contains('remove-row')) {
        const row = e.target.closest('.ingredient-row');
        const container = row.parentElement;
        if (container.querySelectorAll('.ingredient-row').length > 1) {
            row.remove();
        }
    }
});



</script>

</x-layout>
