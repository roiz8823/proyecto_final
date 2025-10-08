<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Motorcycle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('motorcycle.user')
            ->orderBy('reservationDate', 'desc')
            ->orderBy('reservationTime', 'desc')
            ->paginate(10);
            
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $motorcycles = Motorcycle::with('user')
            ->where('status', 1)
            ->get();
            
        return view('reservations.create', compact('motorcycles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'reservationDate' => 'required|date|after_or_equal:today',
            'reservationTime' => 'required',
            'status' => 'required|integer|between:0,3',
            'notes' => 'nullable|string|max:500'
        ]);

        // Verificar disponibilidad de la fecha y hora
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

        Reservation::create($validated);

        return redirect()->route('reservations.index')
                        ->with('success', 'Reserva creada exitosamente');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('motorcycle.user');
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $motorcycles = Motorcycle::with('user')
            ->where('status', 1)
            ->get();
            
        return view('reservations.edit', compact('reservation', 'motorcycles'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'idMotorcycle' => 'required|exists:motorcycle,idMotorcycle',
            'reservationDate' => 'required|date',
            'reservationTime' => 'required',
            'status' => 'required|integer|between:0,3',
            'notes' => 'nullable|string|max:500'
        ]);

        // Verificar disponibilidad (excluyendo la reserva actual)
        $existingReservation = Reservation::where('reservationDate', $validated['reservationDate'])
            ->where('reservationTime', $validated['reservationTime'])
            ->where('idMotorcycle', $validated['idMotorcycle'])
            ->where('idReservation', '!=', $reservation->idReservation)
            ->whereIn('status', [1, 2]) // Pendiente o Confirmada
            ->exists();

        if ($existingReservation) {
            return back()->withErrors([
                'reservationTime' => 'Ya existe otra reserva para esta motocicleta en la fecha y hora seleccionada.'
            ])->withInput();
        }

        $reservation->update($validated);

        return redirect()->route('reservations.index')
                        ->with('success', 'Reserva actualizada exitosamente');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
                        ->with('success', 'Reserva eliminada exitosamente');
    }

    // Método adicional para cambiar estado rápido
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|integer|between:0,3'
        ]);

        $reservation->update(['status' => $request->status]);

        return back()->with('success', 'Estado de la reserva actualizado');
    }
    
}