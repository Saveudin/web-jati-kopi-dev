<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Models\StockMovement;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('recipes.rawMaterial')->get();
        $sales = Sale::with('saleItems.product')->get();
        return view('components.transaction', compact('sales', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function report(Request $request)
{
    $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
    $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

    $sales = Sale::with('saleItems.product')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    $totalRevenue = $sales->sum(function ($sale) {
        return $sale->saleItems->sum('subtotal');
    });

    return view('components.sales', compact('sales', 'startDate', 'endDate', 'totalRevenue'));
}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     

public function exportPDF()
{
    $sales = Sale::with('saleItems.product')->get();

    $totalRevenue = 0;
    foreach ($sales as $sale) {
        foreach ($sale->saleItems as $item) {
            $totalRevenue += $item->subtotal;
        }
    }

    $pdf = Pdf::loadView('components.sales_pdf', compact('sales', 'totalRevenue'));
    return $pdf->download('laporan-penjualan.pdf');
}

public function store(Request $request) 
{
    $request->validate([
        'product_ids' => 'required|array',
        'quantities' => 'required|array',
    ]);

    foreach ($request->product_ids as $index => $product_id) {
        $product = Product::with('recipes.rawMaterial')->findOrFail($product_id);
        $qty = $request->quantities[$index];

        foreach ($product->recipes as $recipe) {
            $requiredQty = $recipe->quantity * $qty;
            $material = $recipe->rawMaterial;

            if ($material->stock < $requiredQty) {
                return back()->withErrors('Stok bahan baku "' . $material->name . '" tidak mencukupi untuk membuat produk "' . $product->name . '"');
            }
        }
    }

    $totalPrice = 0;

    foreach ($request->product_ids as $index => $product_id) {
        $product = Product::findOrFail($product_id);
        $qty = $request->quantities[$index];
        $totalPrice += $product->price * $qty;
    }

    $sale = Sale::create([
        'user_id' => 1,
        'total' => $totalPrice,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($request->product_ids as $index => $product_id) {
        $product = Product::with('recipes.rawMaterial')->findOrFail($product_id);
        $qty = $request->quantities[$index];

        SaleItem::create([
            'sale_id' => $sale->id,
            'product_id' => $product_id,
            'quantity' => $qty,
            'subtotal' => $product->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($product->recipes as $recipe) {
            $usedQty = $recipe->quantity * $qty;
            $recipe->rawMaterial->decrement('stock', $usedQty);
            StockMovement::create([
                'raw_material_id' => $recipe->raw_material_id,
                'change' => -$usedQty,
                'type' => 'usage',
                'note' => 'Digunakan untuk penjualan produk: ' . $product->name,
                'created_at' => now(),
            ]);
            
        }
    }
    return redirect()->route('sales')->with('success', 'Transaksi berhasil disimpan');
}


//     public function store(Request $request)
// {
//     $request->validate([
//         'product_ids' => 'required|array',
//         'quantities' => 'required|array',
//     ]);

//     $totalPrice = 0;

//     foreach ($request->product_ids as $index => $product_id) {
//         $product = Product::findOrFail($product_id);
//         $qty = $request->quantities[$index];
//         $totalPrice += $product->price * $qty;
//     }

//     $sale = Sale::create([
//         'user_id' => 1,
//         'total' => $totalPrice,
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//     foreach ($request->product_ids as $index => $product_id) {
//         $product = Product::with('recipes.rawMaterial')->findOrFail($product_id);
//         $qty = $request->quantities[$index];

//         SaleItem::create([
//             'sale_id' => $sale->id,
//             'product_id' => $product_id,
//             'quantity' => $qty,
//             'subtotal' => $product->price,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);

//         // Kurangi bahan baku berdasarkan resep
//         foreach ($product->recipes as $recipe) {
//             $usedQty = $recipe->quantity * $qty;
//             $recipe->rawMaterial->decrement('stock', $usedQty);
//         }
//     }

//     return redirect()->route('sales')->with('success', 'Transaksi berhasil disimpan');
// }


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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
