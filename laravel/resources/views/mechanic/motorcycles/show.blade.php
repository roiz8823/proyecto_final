@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-motorcycle me-2"></i>Detalles de Motocicleta
            </h1>
        </div>
        <a href="{{ route('mechanic.motorcycles.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <!-- Información de la motocicleta -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información de la Motocicleta
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4 fw-bold text-muted">Marca:</div>
                        <div class="col-8">{{ $motorcycle->brand }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 fw-bold text-muted">Modelo:</div>
                        <div class="col-8">{{ $motorcycle->model }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 fw-bold text-muted">Año:</div>
                        <div class="col-8">
                            <span class="badge bg-secondary">{{ $motorcycle->year }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 fw-bold text-muted">Placa:</div>
                        <div class="col-8">
                            <span class="badge bg-dark fs-6">{{ $motorcycle->licensePlate }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 fw-bold text-muted">Estado:</div>
                        <div class="col-8">
                            @if($motorcycle->status == 1)
                                <span class="badge bg-success p-2">Activa</span>
                            @else
                                <span class="badge bg-danger p-2">Inactiva</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Información del Propietario
                    </h5>
                </div>
                <div class="card-body">
                    @if($motorcycle->user)
                        <div class="text-center mb-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white fa-lg"></i>
                            </div>
                            <h6 class="mb-1">{{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }}</h6>
                            @if($motorcycle->user->secondLastName)
                                <small class="text-muted">{{ $motorcycle->user->secondLastName }}</small>
                            @endif
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-muted">Email:</div>
                            <div class="col-8">
                                <i class="fas fa-envelope text-muted me-1"></i>
                                {{ $motorcycle->user->email }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-muted">Teléfono:</div>
                            <div class="col-8">
                                @if($motorcycle->user->phone)
                                    <i class="fas fa-phone text-muted me-1"></i>
                                    {{ $motorcycle->user->phone }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('mechanic.clients.show', $motorcycle->user->idUser) }}" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-list me-1"></i> Ver todas sus motos
                            </a>
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>No hay información del propietario</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Reservas</h6>
                            <h3 class="mb-0">{{ $motorcycle->reservations->count() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-check fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Mantenimientos</h6>
                            <h3 class="mb-0">{{ $motorcycle->maintenances->count() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-cog fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Estado</h6>
                            <h5 class="mb-0">
                                @if($motorcycle->status == 1)
                                    Activa
                                @else
                                    Inactiva
                                @endif
                            </h5>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Año</h6>
                            <h3 class="mb-0">{{ $motorcycle->year }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Reservas -->
    <div class="card shadow border-0">
        <div class="card-header bg-secondary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-history me-2"></i>Últimas Reservas
            </h5>
        </div>
        <div class="card-body">
            @if($motorcycle->reservations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($motorcycle->reservations->take(5) as $reservation)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($reservation->reservationDate)->format('d/m/Y') }}</td>
                                    <td>{{ $reservation->reservationTime }}</td>
                                    <td>
                                        @if($reservation->status == 1)
                                            <span class="badge bg-warning text-dark">Pendiente</span>
                                        @elseif($reservation->status == 2)
                                            <span class="badge bg-success">Confirmada</span>
                                        @else
                                            <span class="badge bg-danger">Cancelada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $reservation->notes ?? 'Sin notas' }}</small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-3">
                    <i class="fas fa-calendar-times fa-2x mb-2"></i>
                    <p>No hay reservas registradas para esta motocicleta</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection