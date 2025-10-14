@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-calendar-alt me-2"></i>Lista de Reservas
            </h1>
        </div>
        <a href="{{ route('mechanic.reservations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nueva Reserva
        </a>
    </div>

    <div class="card shadow border-0">
        <!-- Card Header con color -->
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-list me-2 fs-5"></i>
                    <h5 class="mb-0 fw-bold">Reservas Registradas</h5>
                </div>
                <span class="badge bg-light text-primary fs-6">{{ $reservations->count() }} reservas</span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="bg-primary">Nro</th>
                            <th class="bg-primary">Motocicleta</th>
                            <th class="bg-primary">Cliente</th>
                            <th class="bg-primary">Fecha</th>
                            <th class="bg-primary">Hora</th>
                            <th class="bg-primary">Estado</th>
                            <th class="bg-primary text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro</th>
                            <th>Motocicleta</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($reservations as $key => $reservation)
                            <tr class="align-middle">
                                <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                <td>
                                    @if($reservation->motorcycle)
                                        <strong class="text-dark">{{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i>{{ $reservation->motorcycle->licensePlate }}
                                        </small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($reservation->motorcycle && $reservation->motorcycle->user)
                                        <i class="fas fa-user text-muted me-1"></i>
                                        {{ $reservation->motorcycle->user->firstName }} {{ $reservation->motorcycle->user->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-calendar text-muted me-1"></i>
                                    {{ $reservation->reservationDate->format('d/m/Y') }}
                                </td>
                                <td>
                                    <i class="fas fa-clock text-muted me-1"></i>
                                    {{ $reservation->reservationTime }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $reservation->status_class }} p-2">
                                        {{ $reservation->status_text }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mechanic.reservations.show', $reservation->idReservation) }}" 
                                           class="btn btn-info btn-sm shadow-sm" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    </div>
                                </td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection