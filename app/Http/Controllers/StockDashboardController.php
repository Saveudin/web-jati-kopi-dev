<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Models\RawMaterial;
use Illuminate\Support\Facades\DB;

class StockDashboardController extends Controller
{
    public function index()
{
    $totalIn = StockMovement::where('type', 'in')->sum('change');
    $totalOut = StockMovement::where('type', 'out')->sum(DB::raw('ABS(`change`)'));

    $topUsedMaterials = StockMovement::select('raw_material_id', DB::raw('SUM(`change`) as total_used'))
        ->where('type', 'out')
        ->groupBy('raw_material_id')
        ->orderBy('total_used', 'desc')
        ->limit(5)
        ->with('rawMaterial')
        ->get();

    return view('dashboard.stock', compact('totalIn', 'totalOut', 'topUsedMaterials'));
}
}
