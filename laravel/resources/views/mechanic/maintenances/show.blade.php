@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-tools me-2"></i>Detalles del Mantenimiento
            </h1>
        </div>
        <a href="{{ route('mechanic.maintenances.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-md-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información del Mantenimiento
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Motocicleta:</label>
                                <p class="fs-5">
                                    @if($maintenance->motorcycle)
                                        {{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}
                                        <br>
                                        <small class="text-muted">
                                            Placa: {{ $maintenance->motorcycle->licensePlate }}
                                        </small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Fecha:</label>
                                <p class="fs-5">
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    {{ $maintenance->maintenanceDate->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted">Diagnóstico:</label>
                        <div class="border rounded p-3 bg-light">
                            {{ $maintenance->diagnosis ?? 'No especificado' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted">Repuestos Utilizados:</label>
                        <div class="border rounded p-3 bg-light">
                            {{ $maintenance->partsUsed ?? 'No se utilizaron repuestos' }}
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
                        <i class="fas fa-calculator me-2"></i>Detalles de Costo
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="h2 text-success fw-bold">Bs {{ number_format($maintenance->cost, 2) }}</div>
                        <small class="text-muted">Costo Total</small>
                    </div>
                </div>
            </div>

            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-user-cog me-2"></i>Información del Responsable
                    </h5>
                </div>
                <div class="card-body">
                    @if($maintenance->mechanic)
                        <div class="text-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white fa-lg"></i>
                            </div>
                            <h6 class="mb-1">{{ $maintenance->mechanic->firstName }} {{ $maintenance->mechanic->lastName }}</h6>
                            <p class="text-muted mb-2">{{ $maintenance->mechanic->email }}</p>
                        </div>
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>No asignado</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estado del Mantenimiento -->
    <div class="card shadow border-0">
        <div class="card-header bg-secondary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-tasks me-2"></i>Estado del Mantenimiento
            </h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-3">
                    <div class="border rounded p-3 {{ $maintenance->status == 0 ? 'bg-warning text-dark' : 'bg-light' }}">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h6>Pendiente</h6>
                    </div>
                </div>
                <div class="col-3">
                    <div class="border rounded p-3 {{ $maintenance->status == 1 ? 'bg-info text-white' : 'bg-light' }}">
                        <i class="fas fa-cog fa-2x mb-2"></i>
                        <h6>En Progreso</h6>
                    </div>
                </div>
                <div class="col-3">
                    <div class="border rounded p-3 {{ $maintenance->status == 2 ? 'bg-success text-white' : 'bg-light' }}">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h6>Completado</h6>
                    </div>
                </div>
                <div class="col-3">
                    <div class="border rounded p-3 {{ $maintenance->status == 3 ? 'bg-danger text-white' : 'bg-light' }}">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <h6>Cancelado</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection