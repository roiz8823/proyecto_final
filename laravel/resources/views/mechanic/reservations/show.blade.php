@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-calendar-check me-2"></i>Detalles de la Reserva
            </h1>
        </div>
        <a href="{{ route('mechanic.reservations.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-md-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información de la Reserva
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Motocicleta:</label>
                                <p class="fs-5">
                                    @if($reservation->motorcycle)
                                        {{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}
                                        <br>
                                        <small class="text-muted">
                                            Placa: {{ $reservation->motorcycle->licensePlate }}
                                        </small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Fecha y Hora:</label>
                                <p class="fs-5">
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    {{ $reservation->reservationDate->format('d/m/Y') }}
                                    <br>
                                    <i class="fas fa-clock text-primary me-1"></i>
                                    {{ $reservation->reservationTime }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted">Notas:</label>
                        <div class="border rounded p-3 bg-light">
                            {{ $reservation->notes ?? 'No hay notas adicionales' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información Secundaria -->
        <div class="col-md-4">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Información del Cliente
                    </h5>
                </div>
                <div class="card-body">
                    @if($reservation->motorcycle && $reservation->motorcycle->user)
                        <div class="text-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white fa-lg"></i>
                            </div>
                            <h6 class="mb-1">{{ $reservation->motorcycle->user->firstName }} {{ $reservation->motorcycle->user->lastName }}</h6>
                            <p class="text-muted mb-2">{{ $reservation->motorcycle->user->email }}</p>
                            @if($reservation->motorcycle->user->phone)
                                <p class="mb-2">
                                    <i class="fas fa-phone text-muted me-1"></i>
                                    {{ $reservation->motorcycle->user->phone }}
                                </p>
                            @endif
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('mechanic.clients.show', $reservation->motorcycle->user->idUser) }}" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-motorcycle me-1"></i> Ver todas sus motos
                            </a>
                        </div>
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>No hay información del cliente</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estado de la Reserva -->
    <div class="card shadow border-0">
        <div class="card-header bg-secondary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-tasks me-2"></i>Gestión del Estado
            </h5>
        </div>
        <div class="card-body">
            <div class="row text-center mb-4">
                <div class="col-3">
                    <div class="border rounded p-3 {{ $reservation->status == 0 ? 'bg-danger text-white' : 'bg-light' }}">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <h6>Cancelada</h6>
                    </div>
                </div>
                <div class="col-3">
                    <div class="border rounded p-3 {{ $reservation->status == 1 ? 'bg-warning text-dark' : 'bg-light' }}">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h6>Pendiente</h6>
                    </div>
                </div>
                <div class="col-3">
                    <div class="border rounded p-3 {{ $reservation->status == 2 ? 'bg-success text-white' : 'bg-light' }}">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h6>Confirmada</h6>
                    </div>
                </div>
                <div class="col-3">
                    <div class="border rounded p-3 {{ $reservation->status == 3 ? 'bg-info text-white' : 'bg-light' }}">
                        <i class="fas fa-flag-checkered fa-2x mb-2"></i>
                        <h6>Completada</h6>
                    </div>
                </div>
            </div>

           @if($reservation->status != 0 && $reservation->status != 3)
            <div class="text-center">
                @if($reservation->status == 1)
                    <form action="{{ route('mechanic.reservations.updateStatus', $reservation->idReservation) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="2">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="fas fa-check me-1"></i> Confirmar Reserva
                        </button>
                    </form>
                @endif
                
                <form action="{{ route('mechanic.reservations.updateStatus', $reservation->idReservation) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="0">
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('¿Estás seguro de cancelar esta reserva?')">
                        <i class="fas fa-times me-1"></i> Cancelar Reserva
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection