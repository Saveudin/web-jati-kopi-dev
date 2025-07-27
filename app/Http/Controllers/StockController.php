<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('product.rawMaterial.recipe')->paginate(7);
        return view('components.StockControl', compact('stocks'));
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
        //
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
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($id);
        $oldQuantity = $stock->quantity;
        $newQuantity = $request->input('quantity');
        $difference = $newQuantity - $oldQuantity;

        // Ambil produk terkait dan resep-resepnya
        $product = $stock->product;
        $recipes = $product->recipes;

        foreach ($recipes as $recipe) {
            $rawMaterial = $recipe->rawMaterial;
            if ($rawMaterial) {
                $materialUsage = $recipe->quantity * abs($difference);

                if ($difference > 0) {
                    // Tambah stok: Kurangi bahan baku
                    if ($rawMaterial->stock < $materialUsage) {
                        return back()->with('error', 'Stok bahan baku "' . $rawMaterial->name . '" tidak mencukupi.');
                    }

                    $rawMaterial->decrement('stock', $materialUsage);
                } elseif ($difference < 0) {
                    // Kurangi stok: Kembalikan bahan baku
                    $rawMaterial->increment('stock', $materialUsage);
                }
            }
        }

        // Update stok produk
        $stock->update(['quantity' => $newQuantity]);

        return redirect()->route('stock-control')->with('success', 'Stock updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
