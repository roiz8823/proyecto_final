@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-calendar-plus me-2"></i>Gestión de Reservas
                </h1>
                <p class="page-subtitle">Administra tus reservas de mantenimiento</p>
            </div>
            <button class="btn btn-warning-custom" data-bs-toggle="modal" data-bs-target="#nuevaReservaModal">
                <i class="fas fa-plus me-1"></i> Nueva Reserva
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-custom alert-info-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Estadísticas -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->where('status', 1)->count() }}</div>
            <div class="stat-label">Pendientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->where('status', 2)->count() }}</div>
            <div class="stat-label">Confirmadas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->where('status', 3)->count() }}</div>
            <div class="stat-label">Completadas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->where('status', 0)->count() }}</div>
            <div class="stat-label">Canceladas</div>
        </div>
    </div>

    <!-- Lista de Reservas -->
    <div class="content-card">
        <div class="card-header-custom">
            <h3 class="card-title-custom">
                <i class="fas fa-list me-2"></i>Mis Reservas
            </h3>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover table-custom">
                <thead>
                    <tr>
                        <th>Motocicleta</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Notas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                    <tr>
                        <td>
                            <strong>{{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}</strong>
                            <br>
                            <small class="text-muted">{{ $reservation->motorcycle->licensePlate }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservationDate)->format('d/m/Y') }}</td>
                        <td>{{ $reservation->reservationTime }}</td>
                        <td>
                            @if($reservation->status == 1)
                                <span class="badge-custom badge-pending">{{ $reservation->status_text }}</span>
                            @elseif($reservation->status == 2)
                                <span class="badge-custom badge-confirmed">{{ $reservation->status_text }}</span>
                            @elseif($reservation->status == 3)
                                <span class="badge-custom badge-completed">{{ $reservation->status_text }}</span>
                            @else
                                <span class="badge-custom badge-cancelled">{{ $reservation->status_text }}</span>
                            @endif
                        </td>
                        <td>
                            @if($reservation->notes)
                                <span title="{{ $reservation->notes }}">
                                    {{ Str::limit($reservation->notes, 30) }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @if($reservation->status == 1)
                                    <button class="btn btn-warning btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editarReservaModal"
                                            data-reservation="{{ $reservation }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('cliente.reservas.cancel', $reservation->idReservation) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Cancelar esta reserva?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fas fa-calendar-times empty-state-icon"></i>
                                <h4 class="empty-state-title">No tienes reservas</h4>
                                <p class="empty-state-text">Haz tu primera reserva haciendo clic en "Nueva Reserva"</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            <div class="pagination-custom">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modales (mantener igual que antes) -->
<!-- ... -->

@endsection