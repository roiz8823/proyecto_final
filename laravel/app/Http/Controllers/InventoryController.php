<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventorys = Inventory::all();
        return view('inventory.index', compact('inventorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idPart' => 'required|unique:inventory|max:50',
            'name' => 'required|max:100',
            'description' => 'required',
            'category' => 'required|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|integer',
            'registrationDate' => 'required|date'
        ]);

        Inventory::create($validated);

        return redirect()->route('inventory.index')
                         ->with('success', 'Repuesto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($idPart)
    {
        $inventory = Inventory::where('idPart', $idPart)->firstOrFail();
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idPart)
    {
        $inventory = Inventory::where('idPart', $idPart)->firstOrFail();
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idPart)
    {
        $inventory = Inventory::where('idPart', $idPart)->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'category' => 'required|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|integer',
            'registrationDate' => 'required|date'
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')
                         ->with('success', 'Repuesto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idPart)
    {
        $inventory = Inventory::where('idPart', $idPart)->firstOrFail();
        $inventory->delete();

        return redirect()->route('inventory.index')
                         ->with('success', 'Repuesto eliminado exitosamente');
    }
}
