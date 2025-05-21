<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;
use App\Models\StockMovement;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all raw materials from the database
        $materials = RawMaterial::paginate(7);

        // Return the materials view with the materials data
        return view('components.materials', compact('materials'));   
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
        $validated = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'unit' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'unit' => $request->input('unit')
        ];

        // Validate the request data
        if ($validated) {
            RawMaterial::create($data);
            $material = RawMaterial::where('name', $request->input('name'))->first();
            StockMovement::create([
                'raw_material_id' => $material->id,
                'change' => +$request->input('stock'),
                'type' => 'restock',
                'note' => 'Restock',
                'created_at' => now(),
            ]);
            return redirect()->route('materials')->with('success', 'Material added successfully');
        }
        else {
            return redirect()->back()->withErrors('Invalid data provided.');
        }

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
        $validated = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|min:1|integer',
            'stock' => 'required|min:1|integer',
            'unit' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'unit' => $request->input('unit')
        ];

        //validate the request data
        if ($validated) {
            // return redirect()->back()->withErrors('All fields are required.');
            RawMaterial::where('id', $id)->update($data);
            $material = RawMaterial::find($id);
            StockMovement::create([
                'raw_material_id' => $material->id,
                'change' => +$request->input('stock'),
                'type' => 'restock',
                'note' => 'Edit Stock',
                'created_at' => now(),
            ]);
            return redirect(route('materials'))->with('success', 'Task updated successfully');
        }
        else {
            return redirect()->back()->withErrors('Invalid data provided.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the material by ID and delete it
        $material = RawMaterial::find($id);
        if ($material) {
            // update stock movement
            StockMovement::create([
                'raw_material_id' => $material->id,
                'change' => -$material->stock,
                'type' => 'delete',
                'note' => 'Delete Material',
                'created_at' => now(),
            ]);
            $material->delete();
            return redirect()->route('materials')->with('success', 'Material deleted successfully');
        } else {
            return redirect()->route('materials')->with('error', 'Material not found');
        }
    }
}
