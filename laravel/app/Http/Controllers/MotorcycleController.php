<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\Http\Request;
use App\Models\User;

class MotorcycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motorcycles = Motorcycle::with('user')->get(); // ¡Carga la relación aquí!
        return view('motorcycles.index', compact('motorcycles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Obtener todos los usuarios para el select
        return view('motorcycles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idUser' => 'required',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'licensePlate' => 'required|string|max:15|unique:motorcycle,licensePlate',
            'recommendations' => 'nullable|string',
        ]);

        Motorcycle::create($request->all());

        return redirect()->route('motorcycles.index')->with('success', 'Motocicleta creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motorcycle $motorcycle)
    {
        return view('motorcycles.show', compact('motorcycle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motorcycle $motorcycle)
    {
        return view('motorcycles.edit', compact('motorcycle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motorcycle $motorcycle)
    {
        $request->validate([
            'idUser' => 'required',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'licensePlate' => 'required|string|max:15|unique:motorcycle,licensePlate,' . $motorcycle->idMotorcycle . ',idMotorcycle',
            'recommendations' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $motorcycle->update($request->all());

        return redirect()->route('motorcycles.index')->with('success', 'Motocicleta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motorcycle $motorcycle)
    {
        $motorcycle->delete();

        return redirect()->route('motorcycles.index')->with('success', 'Motocicleta eliminada exitosamente.');
    }
}
