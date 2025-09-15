<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Motorcycle;
use App\Models\User;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenance.index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $motorcycles = Motorcycle::where('status', 1)->get();
        $mechanics = User::where('role', 'mechanic')->where('status', 1)->get();
        return view('maintenance.create', compact('motorcycles', 'mechanics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'idMechanic' => 'required|exists:user,idUser',
            'diagnosis' => 'required|string',
            'serviceDetails' => 'required|string',
            'partsUsed' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|integer|between:0,3',
            'notes' => 'nullable|string',
            'maintenanceDate' => 'required|date',
        ]);

        Maintenance::create($validated);

        return redirect()->route('maintenance.index')
                        ->with('success', 'Mantenimiento registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        $motorcycles = Motorcycle::where('status', 1)->get();
        $mechanics = User::where('role', 'mechanic')->where('status', 1)->get();
        return view('maintenance.show', compact('maintenance', 'motorcycles', 'mechanics'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        $motorcycles = Motorcycle::where('status', 1)->get();
        $mechanics = User::where('role', 'mechanic')->where('status', 1)->get();
        return view('maintenance.edit', compact('maintenance', 'motorcycles', 'mechanics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'idMechanic' => 'required|exists:user,idUser',
            'diagnosis' => 'required|string',
            'serviceDetails' => 'required|string',
            'partsUsed' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|integer|between:0,3',
            'notes' => 'nullable|string',
            'maintenanceDate' => 'required|date',
        ]);

        $maintenance->update($validated);

        return redirect()->route('maintenance.index')
                        ->with('success', 'Mantenimiento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maintenance->delete();

        return redirect()->route('maintenances.index')
                        ->with('success', 'Mantenimiento eliminado exitosamente');
    }
}
