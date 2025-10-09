@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-motorcycle me-2"></i>{{ $motorcycle->brand }} {{ $motorcycle->model }}
                </h1>
                <p class="page-subtitle">Detalles completos de tu motocicleta</p>
            </div>
            <a href="{{ route('cliente.motocicletas') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-lg-8">
            <!-- Tarjeta de Información General -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información General
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold" width="40%">Marca:</td>
                                    <td>{{ $motorcycle->brand }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Modelo:</td>
                                    <td>{{ $motorcycle->model }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Año:</td>
                                    <td>{{ $motorcycle->year }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold" width="40%">Placa:</td>
                                    <td class="fw-bold text-primary">{{ $motorcycle->licensePlate }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Estado:</td>
                                    <td>
                                        @if($motorcycle->status)
                                            <span class="badge-custom badge-confirmed">Activa</span>
                                        @else
                                            <span class="badge-custom badge-cancelled">Inactiva</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de Mantenimientos -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tools me-2"></i>Historial de Mantenimientos
                        <span class="badge bg-light text-dark ms-2">{{ $motorcycle->maintenances->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($motorcycle->maintenances->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Mecánico</th>
                                        <th>Costo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($motorcycle->maintenances->sortByDesc('maintenanceDate') as $maintenance)
                                    <tr>
                                        <td>{{ $maintenance->maintenanceDate->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge-custom badge-{{ $maintenance->status_class }}">
                                                {{ $maintenance->status_text }}
                                            </span>
                                        </td>
                                        <td>{{ $maintenance->mechanic ? $maintenance->mechanic->firstName . ' ' . $maintenance->mechanic->lastName : 'No asignado' }}</td>
                                        <td class="fw-bold text-success">Bs {{ number_format($maintenance->cost, 2) }}</td>
                                        <td>
                                            <a href="{{ route('cliente.mantenimiento.show', $maintenance) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay mantenimientos registrados para esta motocicleta</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Historial de Reservas -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-calendar-check me-2"></i>Historial de Reservas
                        <span class="badge bg-light text-dark ms-2">{{ $motorcycle->reservations->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($motorcycle->reservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Servicio</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($motorcycle->reservations->sortByDesc('reservationDate') as $reservation)
                                    <tr>
                                        <td>{{ $reservation->reservationDate->format('d/m/Y') }}</td>
                                        <td>{{ $reservation->notes ?? 'General' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $reservation->status_class }}">
                                                {{ $reservation->status_text }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay reservas registradas para esta motocicleta</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar - Estadísticas y Acciones -->
        <div class="col-lg-4">
            <!-- Estadísticas Rápidas -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Estadísticas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="stats-mini">
                        <div class="stat-mini-item">
                            <div class="stat-mini-label">Total Mantenimientos</div>
                            <div class="stat-mini-number text-primary">{{ $motorcycle->maintenances->count() }}</div>
                        </div>
                        <div class="stat-mini-item">
                            <div class="stat-mini-label">Total Reservas</div>
                            <div class="stat-mini-number text-success">{{ $motorcycle->reservations->count() }}</div>
                        </div>
                        <div class="stat-mini-item">
                            <div class="stat-mini-label">Mantenimientos Completados</div>
                            <div class="stat-mini-number text-info">{{ $motorcycle->maintenances->where('status', 2)->count() }}</div>
                        </div>
                        <div class="stat-mini-item">
                            <div class="stat-mini-label">Total Invertido</div>
                            <div class="stat-mini-number text-warning">Bs {{ number_format($motorcycle->maintenances->sum('cost'), 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Último Mantenimiento -->
            @if($motorcycle->maintenances->count() > 0)
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>Último Mantenimiento
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $lastMaintenance = $motorcycle->maintenances->sortByDesc('maintenanceDate')->first();
                    @endphp
                    <div class="maintenance-preview">
                        <div class="mb-2">
                            <strong>Fecha:</strong> {{ $lastMaintenance->maintenanceDate->format('d/m/Y') }}
                        </div>
                        <div class="mb-2">
                            <strong>Estado:</strong>
                            <span class="badge-custom badge-{{ $lastMaintenance->status_class }}">
                                {{ $lastMaintenance->status_text }}
                            </span>
                        </div>
                        <div class="mb-2">
                            <strong>Mecánico:</strong>
                            {{ $lastMaintenance->mechanic ? $lastMaintenance->mechanic->firstName . ' ' . $lastMaintenance->mechanic->lastName : 'No asignado' }}
                        </div>
                        <div class="mb-2">
                            <strong>Costo:</strong>
                            <span class="fw-bold text-success">Bs {{ number_format($lastMaintenance->cost, 2) }}</span>
                        </div>
                        @if($lastMaintenance->diagnosis)
                        <div class="mt-2">
                            <strong>Diagnóstico:</strong>
                            <p class="small mb-0 text-muted">{{ Str::limit($lastMaintenance->diagnosis, 100) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Acciones Rápidas -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Acciones Rápidas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('cliente.reservas.create') }}" class="btn btn-primary-custom">
                            <i class="fas fa-tools me-1"></i> Solicitar Mantenimiento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.card-header {
    border-bottom: 2px solid rgba(0,0,0,0.1);
}

.table-borderless td {
    padding: 8px 0;
    border: none;
}

.stats-mini {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.stat-mini-item {
    text-align: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.stat-mini-number {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.stat-mini-label {
    font-size: 0.8rem;
    color: #6c757d;
}

.badge-custom {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
}

.badge-confirmed { background-color: #d1edff; color: #0c5460; }
.badge-cancelled { background-color: #f8d7da; color: #721c24; }
.badge-pending { background-color: #fff3cd; color: #856404; }
.badge-in-progress { background-color: #cce7ff; color: #004085; }
.badge-completed { background-color: #d1edff; color: #0c5460; }

.maintenance-preview {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #ffc107;
}

</style>
@endsection