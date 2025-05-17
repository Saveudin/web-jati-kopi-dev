<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::paginate(7);
        $products = Product::all();
        $materials = RawMaterial::all();

        return view('components.recipes', compact('recipes', 'products', 'materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'raw_materials' => 'required|array|min:1',
        'quantities' => 'required|array|min:1',
        'unit' => 'required|string',
    ]);

        foreach ($request->raw_materials as $index => $raw_material_id) {
            Recipe::create([
                'product_id' => $request->product_id,
                'raw_material_id' => $raw_material_id,
                'quantity' => $request->quantities[$index],
                'unit' => $request->unit,
            ]);
        }

    return redirect()->route('recipes')->with('success', 'Resep berhasil disimpan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());

        return redirect()->route('recipes')->with('success', 'Resep berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return redirect()->route('recipes')->with('success', 'Resep berhasil dihapus.');
    }
}
