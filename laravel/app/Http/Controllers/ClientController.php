<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Maintenance;
use App\Models\Motorcycle;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Dashboard principal del cliente
     */
    public function dashboard()
    {
        $userId = Auth::id();
        
        // Estadísticas para el dashboard
        $stats = [
            'total_motorcycles' => Motorcycle::where('idUser', $userId)->count(),
            'pending_reservations' => Reservation::whereHas('motorcycle', function($query) use ($userId) {
                $query->where('idUser', $userId);
            })->where('status', 1)->count(),
            'completed_maintenances' => Maintenance::whereHas('motorcycle', function($query) use ($userId) {
                $query->where('idUser', $userId);
            })->where('status', 2)->count(),
            'active_parts' => Store::where('status', 1)->where('stock', '>', 0)->count()
        ];

        return view('clients.dashboard', compact('stats'));
    }

    /**
     * Opción 1: Gestión de Reservas (Ver, Crear, Editar)
     */
    public function reservas()
    {
        $userId = Auth::id();
        
        // Obtener las motocicletas del usuario
        $motorcycles = Motorcycle::where('idUser', $userId)
            ->where('status', 1)
            ->get();
            
        // Obtener las reservas del usuario
        $reservations = Reservation::with('motorcycle')
            ->whereIn('idMotorcycle', $motorcycles->pluck('idMotorcycle'))
            ->orderBy('reservationDate', 'desc')
            ->orderBy('reservationTime', 'desc')
            ->paginate(10);

        // Horarios disponibles
        $availableTimes = [
            '08:00', '09:00', '10:00', '11:00', 
            '12:00', '13:00', '14:00', '15:00', 
            '16:00', '17:00', '18:00'
        ];

        return view('clients.reservas.index', compact('reservations', 'motorcycles', 'availableTimes'));
    }

    /**
     * Crear nueva reserva
     */
    public function storeReserva(Request $request)
    {
        $userId = Auth::id();
        
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'reservationDate' => 'required|date|after_or_equal:today',
            'reservationTime' => 'required',
            'notes' => 'nullable|string|max:500'
        ]);

        // Verificar que la motocicleta pertenece al usuario
        $userMotorcycle = Motorcycle::where('idMotorcycle', $validated['idMotorcycle'])
            ->where('idUser', $userId)
            ->first();

        if (!$userMotorcycle) {
            return back()->withErrors(['idMotorcycle' => 'La motocicleta seleccionada no te pertenece.']);
        }

        // Verificar disponibilidad
        $existingReservation = Reservation::where('reservationDate', $validated['reservationDate'])
            ->where('reservationTime', $validated['reservationTime'])
            ->where('idMotorcycle', $validated['idMotorcycle'])
            ->whereIn('status', [1, 2]) // Pendiente o Confirmada
            ->exists();

        if ($existingReservation) {
            return back()->withErrors([
                'reservationTime' => 'Ya existe una reserva para esta motocicleta en la fecha y hora seleccionada.'
            ])->withInput();
        }

        // Crear reserva con estado pendiente por defecto
        Reservation::create([
            'idMotorcycle' => $validated['idMotorcycle'],
            'reservationDate' => $validated['reservationDate'],
            'reservationTime' => $validated['reservationTime'],
            'notes' => $validated['notes'],
            'status' => 1 // Pendiente
        ]);

        return redirect()->route('clients.reservas')
                        ->with('success', 'Reserva creada exitosamente. Estará pendiente de confirmación.');
    }

    /**
     * Actualizar reserva existente
     */
    public function updateReserva(Request $request, Reservation $reservation)
    {
        $userId = Auth::id();
        
        // Verificar que la reserva pertenece al usuario
        $userReservation = Reservation::where('idReservation', $reservation->idReservation)
            ->whereHas('motorcycle', function($query) use ($userId) {
                $query->where('idUser', $userId);
            })
            ->first();

        if (!$userReservation) {
            return back()->withErrors(['error' => 'No tienes permiso para editar esta reserva.']);
        }

        // Solo permitir editar si está pendiente
        if ($reservation->status != 1) {
            return back()->withErrors(['error' => 'Solo puedes editar reservas pendientes.']);
        }

        $validated = $request->validate([
            'reservationDate' => 'required|date|after_or_equal:today',
            'reservationTime' => 'required',
            'notes' => 'nullable|string|max:500'
        ]);

        // Verificar disponibilidad (excluyendo la reserva actual)
        $existingReservation = Reservation::where('reservationDate', $validated['reservationDate'])
            ->where('reservationTime', $validated['reservationTime'])
            ->where('idMotorcycle', $reservation->idMotorcycle)
            ->where('idReservation', '!=', $reservation->idReservation)
            ->whereIn('status', [1, 2]) // Pendiente o Confirmada
            ->exists();

        if ($existingReservation) {
            return back()->withErrors([
                'reservationTime' => 'Ya existe otra reserva para esta motocicleta en la fecha y hora seleccionada.'
            ])->withInput();
        }

        $reservation->update($validated);

        return redirect()->route('clients.reservas')
                        ->with('success', 'Reserva actualizada exitosamente.');
    }

    /**
     * Cancelar reserva
     */
    public function cancelReserva(Reservation $reservation)
    {
        $userId = Auth::id();
        
        // Verificar que la reserva pertenece al usuario
        $userReservation = Reservation::where('idReservation', $reservation->idReservation)
            ->whereHas('motorcycle', function($query) use ($userId) {
                $query->where('idUser', $userId);
            })
            ->first();

        if (!$userReservation) {
            return back()->withErrors(['error' => 'No tienes permiso para cancelar esta reserva.']);
        }

        // Solo permitir cancelar si está pendiente
        if ($reservation->status != 1) {
            return back()->withErrors(['error' => 'Solo puedes cancelar reservas pendientes.']);
        }

        $reservation->delete();

        return redirect()->route('clients.reservas')
                        ->with('success', 'Reserva cancelada exitosamente.');
    }

    /**
     * Opción 2: Historial de Mantenimiento
     */
    public function historialMantenimiento()
    {
        $userId = Auth::id();
        
        $maintenances = Maintenance::with(['motorcycle', 'mechanic'])
            ->whereHas('motorcycle', function($query) use ($userId) {
                $query->where('idUser', $userId);
            })
            ->orderBy('maintenanceDate', 'desc')
            ->paginate(10);

        return view('clients.mantenimiento.historial', compact('maintenances'));
    }

    /**
     * Opción 3: Mis Motocicletas
     */
    public function misMotocicletas()
    {
        $userId = Auth::id();
        
        $motorcycles = Motorcycle::where('idUser', $userId)
            ->withCount([
                'reservations',
                'maintenances' // Esta relación ahora existe
            ])
            ->orderBy('brand')
            ->get();

        return view('clients.motocicletas.index', compact('motorcycles'));
    }

    /**
     * Mostrar detalles de una motocicleta
     */
    public function showMotocicleta(Motorcycle $motorcycle)
    {
        $userId = Auth::id();
        
        // Verificar que la motocicleta pertenece al usuario
        if ($motorcycle->idUser != $userId) {
            abort(403, 'No tienes permiso para ver esta motocicleta.');
        }

        $motorcycle->load(['reservations', 'maintenances.mechanic']);

        return view('clients.motocicletas.show', compact('motorcycle'));
    }

    /**
     * Opción 4: Repuestos Disponibles
     */
    public function repuestos()
    {
        $repuestos = Store::where('status', 1)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->paginate(12);

        $categories = Store::distinct()->pluck('category')->filter();

        return view('clients.repuestos.index', compact('repuestos', 'categories'));
    }

    /**
     * Filtrar repuestos por categoría
     */
    public function repuestosPorCategoria($category)
    {
        $repuestos = Store::where('status', 1)
            ->where('stock', '>', 0)
            ->where('category', $category)
            ->orderBy('name')
            ->paginate(12);

        $categories = Store::distinct()->pluck('category')->filter();

        return view('clients.repuestos.index', compact('repuestos', 'categories'));
    }
}