<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Maintenance;
use App\Models\Motorcycle;
use App\Models\Store;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechaniController extends Controller
{
    /**
     * Dashboard principal del mecánico
     */
    public function dashboard()
    {

        return view('mechanic.dashboard');
    }

    /**
     * Opción 1: Gestión de Clientes
     */
    public function clients()
    {
        $clients = User::where('status', 1)
            ->orderBy('firstName')
            ->paginate(10);

        return view('mechanic.clients.index', compact('clients'));
    }

    /**
     * Mostrar detalles de un cliente específico
     */
    public function showClient(User $client)
    {
        // Cargar solo las motocicletas del cliente
        $client->load('motorcycles');
        
        return view('mechanic.clients.show', compact('client'));
    }

    /**
     * Opción 2: Gestión de Motocicletas
     */
    public function motorcycles()
    {
        $motorcycles = Motorcycle::with(['user', 'reservations', 'maintenances'])
            ->where('status', 1)
            ->orderBy('brand')
            ->paginate(10);

        return view('mechanic.motorcycles.index', compact('motorcycles'));
    }

    /**
     * Mostrar detalles de una motocicleta
     */
    public function showMotorcycle(Motorcycle $motorcycle)
    {
        $motorcycle->load(['user', 'reservations', 'maintenances']);
        
        return view('mechanic.motorcycles.show', compact('motorcycle'));
    }

    /**
     * Opción 3: Gestión de Mantenimientos
     */
    public function maintenances()
    {
        $maintenances = Maintenance::with(['motorcycle.user', 'mechanic'])
            ->orderBy('maintenanceDate', 'desc')
            ->paginate(10);

        return view('mechanic.maintenances.index', compact('maintenances'));
    }

    /**
     * Mostrar detalles de un mantenimiento
     */
    public function showMaintenance(Maintenance $maintenance)
    {
        $maintenance->load(['motorcycle.user', 'mechanic']);
        
        return view('mechanic.maintenances.show', compact('maintenance'));
    }

    /**
     * Formulario para crear nuevo mantenimiento
     */
    public function createMaintenance()
    {
        $motorcycles = Motorcycle::where('status', 1)->get();
        $mechanics = User::where('status', 1)->get(); // Asumiendo que los mecánicos son usuarios
        
        return view('mechanic.maintenances.create', compact('motorcycles', 'mechanics'));
    }

    /**
     * Guardar nuevo mantenimiento
     */
    public function storeMaintenance(Request $request)
    {
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'maintenanceDate' => 'required|date',
            'maintenanceType' => 'required|string|max:100',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:1,2,3' // 1: Pendiente, 2: En proceso, 3: Completado
        ]);

        try {
            Maintenance::create([
                'idMotorcycle' => $validated['idMotorcycle'],
                'maintenanceDate' => $validated['maintenanceDate'],
                'maintenanceType' => $validated['maintenanceType'],
                'description' => $validated['description'],
                'cost' => $validated['cost'],
                'status' => $validated['status'],
                'idMechanic' => Auth::id() // El mecánico actual como responsable
            ]);

            return redirect()->route('mechani.maintenances')
                ->with('success', 'Mantenimiento registrado exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el mantenimiento: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Opción 4: Gestión de Reservas
     */
    public function reservations()
    {
        $reservations = Reservation::with(['motorcycle.user'])
            ->orderBy('reservationDate', 'desc')
            ->orderBy('reservationTime', 'desc')
            ->paginate(10);

        return view('mechanic.reservations.index', compact('reservations'));
    }

    /**
     * Mostrar detalles de una reserva
     */
    public function showReservation(Reservation $reservation)
    {
        $reservation->load(['motorcycle.user']);
        
        return view('mechanic.reservations.show', compact('reservation'));
    }

    /**
     * Formulario para crear nueva reserva
     */
    public function createReservation()
    {
        $motorcycles = Motorcycle::where('status', 1)->with('user')->get();
        
        return view('mechanic.reservations.create', compact('motorcycles'));
    }
    /**
     * Actualizar estado de una reserva
     */
    public function updateReservationStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:1,2,3' // 1: Pendiente, 2: Confirmada, 3: Cancelada
        ]);

        try {
            $reservation->update([
                'status' => $validated['status']
            ]);

            return redirect()->route('mechanic.reservations.index')
                ->with('success', 'Estado de la reserva actualizado exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la reserva: ' . $e->getMessage());
        }
    }
    /**
     * Guardar nueva reserva
     */
    public function storeReservation(Request $request)
    {
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'reservationDate' => 'required|date|after_or_equal:today',
            'reservationTime' => 'required',
            'status' => 'required|in:1,2',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            Reservation::create([
                'idMotorcycle' => $validated['idMotorcycle'],
                'reservationDate' => $validated['reservationDate'],
                'reservationTime' => $validated['reservationTime'],
                'status' => $validated['status'],
                'notes' => $validated['notes'],
                'creationDate' => now()
            ]);

            return redirect()->route('mechanic.reservations.index')
                ->with('success', 'Reserva creada exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear la reserva: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Opción 5: Gestión de Almacén
     */
    public function store()
    {
        $products = Store::where('status', 1)
            ->orderBy('name')
            ->paginate(12);

        $categories = Store::distinct()->pluck('category')->filter();

        return view('mechanic.store.index', compact('products', 'categories'));
    }

    /**
     * Mostrar detalles de un producto
     */
    public function showProduct(Store $product)
    {
        return view('mechanic.store.show', compact('product'));
    }

    /**
     * Filtrar productos por categoría
     */
    public function productsByCategory($category)
    {
        $products = Store::where('status', 1)
            ->where('category', $category)
            ->orderBy('name')
            ->paginate(12);

        $categories = Store::distinct()->pluck('category')->filter();

        return view('mechanic.store.index', compact('products', 'categories'));
    }

    /**
     * Opción 6: Gestión de Ventas
     */
    public function sales()
    {
        $sales = Sale::with(['user', 'details.part'])
            ->orderBy('saleDate', 'desc')
            ->paginate(10);

        return view('mechanic.sales.index', compact('sales'));
    }

    /**
     * Mostrar detalles de una venta
     */
    public function showSale(Sale $sale)
    {
        $sale->load(['user', 'details.part']);
        
        return view('mechanic.sales.show', compact('sale'));
    }

    /**
     * Formulario para crear nueva venta
     */
    public function createSale()
    {
        $clients = User::where('status', 1)->get();
        $products = Store::where('stock', '>', 0)->where('status', 1)->get();
        
        return view('mechanic.sales.create', compact('clients', 'products'));
    }

    /**
     * Guardar nueva venta
     */
    public function storeSale(Request $request)
    {
        // Implementar lógica similar a SaleController pero adaptada para mecánicos
        // Esta sería una implementación básica
        
        $validated = $request->validate([
            'idUser' => 'required|exists:user,idUser',
            'products' => 'required|array|min:1',
            'products.*.idPart' => 'required|exists:store,idPart',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            // Lógica para crear venta (similar a la que ya tienes en SaleController)
            // ...
            
            return redirect()->route('mechani.sales')
                ->with('success', 'Venta registrada exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar la venta: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Mostrar perfil del mecánico
     */
    public function profile()
    {
        $user = Auth::user();
        return view('mechanic.profile.index', compact('user'));
    }

}