<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::orderBy('name')->paginate(10);
        $categories = Store::distinct()->pluck('category')->filter();
        
        return view('store.index', compact('stores', 'categories'));
    }

    public function create()
    {
        $categories = [
            'Motor', 'Transmisión', 'Frenos', 'Suspensión', 
            'Eléctrico', 'Carrocería', 'Aceites y Lubricantes', 
            'Filtros', 'Neumáticos', 'Sistema de Escape', 'Otros'
        ];
        
        return view('store.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean'
        ]);

        Store::create($validated);

        return redirect()->route('store.index')
                        ->with('success', 'Repuesto agregado al almacén exitosamente');
    }

    public function show(Store $store)
    {
        return view('store.show', compact('store'));
    }

    public function edit(Store $store)
    {
        $categories = [
            'Motor', 'Transmisión', 'Frenos', 'Suspensión', 
            'Eléctrico', 'Carrocería', 'Aceites y Lubricantes', 
            'Filtros', 'Neumáticos', 'Sistema de Escape', 'Otros'
        ];
        
        return view('store.edit', compact('store', 'categories'));
    }

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean'
        ]);

        $store->update($validated);

        return redirect()->route('store.index')
                        ->with('success', 'Repuesto actualizado exitosamente');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('store.index')
                        ->with('success', 'Repuesto eliminado exitosamente');
    }

    // Método para actualizar stock
    public function updateStock(Request $request, Store $store)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $store->update(['stock' => $request->stock]);

        return back()->with('success', 'Stock actualizado exitosamente');
    }

    // Método para filtrar por categoría
    public function byCategory($category)
    {
        $stores = Store::where('category', $category)->paginate(10);
        $categories = Store::distinct()->pluck('category')->filter();
        
        return view('store.index', compact('stores', 'categories'));
    }
}