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
    public function show(Inventoryle $inventoryle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventoryle $inventoryle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventoryle $inventoryle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventoryle $inventoryle)
    {
        //
    }
}
