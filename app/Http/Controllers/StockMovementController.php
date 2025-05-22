<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with('rawMaterial')->latest()->paginate(10);
        return view('stock_movements.index', compact('movements'));
    }
}
