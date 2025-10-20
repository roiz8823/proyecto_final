@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Gestión de Reservas</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-calendar-alt me-1"></i>
                <b>Reservas Registradas</b>
            </div>
            <a href="{{ route('reservations.create') }}" class="btn btn-success btn-sm fw-bold">
                <i class="fas fa-plus"></i> Nueva Reserva
            </a>
        </div>
        <div class="card-header">
            @if(session('success'))
                <p class="text-success">{{ session('success') }}</p>
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Propietario</th>
                        <th>Fecha y Hora</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Propietario</th>
                        <th>Fecha y Hora</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($reservations as $key => $reservation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}<br>
                                {{ $reservation->motorcycle->licensePlate }}
                            </td>
                            <td>{{ $reservation->motorcycle->user->firstName ?? 'N/A' }} {{ $reservation->motorcycle->user->lastName ?? '' }}</td>
                            <td>
                                {{ $reservation->reservationDate->format('d/m/Y') }} <br>
                                {{ $reservation->reservationTime }}
                            </td>
                            <td>{{ $reservation->status_text }}</td>
                            <td>
                                <a href="{{ route('reservations.show', $reservation->idReservation) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('reservations.edit', $reservation->idReservation) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('reservations.destroy', $reservation->idReservation) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar reserva?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection