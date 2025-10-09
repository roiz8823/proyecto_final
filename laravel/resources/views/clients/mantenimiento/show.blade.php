@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-clipboard-list me-2"></i>Detalles del Mantenimiento
                </h1>
                <p class="page-subtitle">Información completa del servicio de mantenimiento</p>
            </div>
            <a href="{{ route('cliente.mantenimiento.historial') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al Historial
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información del Servicio
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold" width="40%">Motocicleta:</td>
                                    <td>{{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Placa:</td>
                                    <td>{{ $maintenance->motorcycle->licensePlate }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Fecha:</td>
                                    <td>{{ $maintenance->maintenanceDate->format('d/m/Y') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold" width="40%">Estado:</td>
                                    <td>
                                        <span class="badge-custom badge-{{ $maintenance->status_class }}">
                                            {{ $maintenance->status_text }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Mecánico:</td>
                                    <td>
                                        {{ $maintenance->mechanic ? $maintenance->mechanic->firstName . ' ' . $maintenance->mechanic->lastName : 'No asignado' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Costo:</td>
                                    <td class="fw-bold text-success">
                                        Bs {{ number_format($maintenance->cost, 2) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagnóstico -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-stethoscope me-2"></i>Diagnóstico
                    </h5>
                </div>
                <div class="card-body">
                    @if($maintenance->diagnosis)
                        <p class="mb-0">{{ $maintenance->diagnosis }}</p>
                    @else
                        <p class="text-muted mb-0">No se registró diagnóstico</p>
                    @endif
                </div>
            </div>

            <!-- Partes Utilizadas -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Partes Utilizadas
                    </h5>
                </div>
                <div class="card-body">
                    @if($maintenance->partsUsed)
                        <p class="mb-0">{{ $maintenance->partsUsed }}</p>
                    @else
                        <p class="text-muted mb-0">No se registraron partes utilizadas</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Información Secundaria -->
        <div class="col-lg-4">
            <!-- Notas -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sticky-note me-2"></i>Notas Adicionales
                    </h5>
                </div>
                <div class="card-body">
                    @if($maintenance->notes)
                        <p class="mb-0">{{ $maintenance->notes }}</p>
                    @else
                        <p class="text-muted mb-0">No hay notas adicionales</p>
                    @endif
                </div>
            </div>

            <!-- Información de la Motocicleta -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-motorcycle me-2"></i>Información de la Motocicleta
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-motorcycle fa-3x text-black"></i>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="fw-bold">Marca:</td>
                            <td>{{ $maintenance->motorcycle->brand }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Modelo:</td>
                            <td>{{ $maintenance->motorcycle->model }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Año:</td>
                            <td>{{ $maintenance->motorcycle->year }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Placa:</td>
                            <td>{{ $maintenance->motorcycle->licensePlate }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('cliente.mantenimiento.historial') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver al Historial
                </a>
                
                @if($maintenance->status == 0) {{-- Pendiente --}}
                <div>
                    <button class="btn btn-outline-warning me-2">
                        <i class="fas fa-edit me-1"></i> Solicitar Cambios
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="fas fa-times me-1"></i> Cancelar Mantenimiento
                    </button>
                </div>
                @endif
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

.badge-custom {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
}

.badge-pending { background-color: #fff3cd; color: #856404; }
.badge-in-progress { background-color: #cce7ff; color: #004085; }
.badge-completed { background-color: #d1edff; color: #0c5460; }
.badge-cancelled { background-color: #f8d7da; color: #721c24; }
</style>
@endsection