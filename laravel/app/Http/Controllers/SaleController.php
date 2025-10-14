<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Detail;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales.
     */
    public function index()
    {
        $sales = Sale::with(['user', 'details.part'])
                    ->orderBy('saleDate', 'desc')
                    ->get();

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create()
    {
        $users = User::where('status', 1)->get();
        $products = Store::where('stock', '>', 0)
                        ->where('status', 1)
                        ->get();

        return view('sales.create', compact('users', 'products'));
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'idUser' => 'required|exists:user,idUser',
            'saleDate' => 'required|date',
            'products' => 'required|array|min:1',
            'products.*.idPart' => 'required|exists:store,idPart',
            'products.*.quantity' => 'required|integer|min:1',
        ], [
            'idUser.required' => 'El cliente es obligatorio',
            'products.required' => 'Debe agregar al menos un producto a la venta',
            'products.*.quantity.required' => 'La cantidad es obligatoria',
            'products.*.quantity.min' => 'La cantidad debe ser al menos 1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Crear la venta
            $sale = Sale::create([
                'idUser' => $request->idUser,
                'saleDate' => $request->saleDate,
                'total' => 0, // Se calculará después
                'status' => 1
            ]);

            $totalSale = 0;

            // Procesar los detalles de la venta
            foreach ($request->products as $productData) {
                $product = Store::find($productData['idPart']);
                
                // Verificar stock disponible
                if ($product->stock < $productData['quantity']) {
                    throw new \Exception("Stock insuficiente para: {$product->name}. Stock disponible: {$product->stock}");
                }

                $unitPrice = $product->price;
                $totalPrice = $productData['quantity'] * $unitPrice;

                // Crear detalle
                Detail::create([
                    'idSale' => $sale->idSale,
                    'idPart' => $productData['idPart'],
                    'quantity' => $productData['quantity'],
                    'unitPrice' => $unitPrice,
                    'totalPrice' => $totalPrice
                ]);

                // Actualizar stock
                $product->decrement('stock', $productData['quantity']);

                $totalSale += $totalPrice;
            }

            // Actualizar total de la venta
            $sale->update(['total' => $totalSale]);

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', '¡Venta registrada exitosamente! Total: $' . number_format($totalSale, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Error al registrar la venta: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified sale.
     */
    public function show($id)
    {
        $sale = Sale::with(['user', 'details.part'])->findOrFail($id);

        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified sale.
     */
    public function edit($id)
    {
        $sale = Sale::with('details.part')->findOrFail($id);
        $users = User::where('status', 1)->get();
        $products = Store::where('stock', '>', 0)->where('status', 1)->get();

        return view('sales.edit', compact('sale', 'users', 'products'));
    }

    /**
     * Update the specified sale in storage.
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'idUser' => 'required|exists:user,idUser',
            'saleDate' => 'required|date',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $sale->update([
                'idUser' => $request->idUser,
                'saleDate' => $request->saleDate,
                'status' => $request->status
            ]);

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', '¡Venta actualizada exitosamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Error al actualizar la venta: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified sale from storage.
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        try {
            DB::beginTransaction();

            // Restaurar stock antes de eliminar
            foreach ($sale->details as $detail) {
                if ($detail->part) {
                    $detail->part->increment('stock', $detail->quantity);
                }
            }

            // Eliminar detalles primero
            Detail::where('idSale', $id)->delete();
            
            // Luego eliminar la venta
            $sale->delete();

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', '¡Venta eliminada exitosamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
        }
    }

    /**
     * Get available products for sale (AJAX)
     */
    public function getAvailableProducts()
    {
        $products = Store::where('stock', '>', 0)
                        ->where('status', 1)
                        ->get(['idPart', 'name', 'price', 'stock', 'category']);

        return response()->json($products);
    }
}