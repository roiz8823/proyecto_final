@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-clipboard-list me-2"></i>Historial de Mantenimiento
        </h1>
        <p class="page-subtitle">Revisa el historial completo de servicios de tus motocicletas</p>
    </div>

    <!-- Filtros -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Filtrar por estado:</label>
                <select class="form-select" id="statusFilter">
                    <option value="">Todos los estados</option>
                    <option value="0">Pendiente</option>
                    <option value="1">En Progreso</option>
                    <option value="2">Completado</option>
                    <option value="3">Cancelado</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Filtrar por motocicleta:</label>
                <select class="form-select" id="motorcycleFilter">
                    <option value="">Todas las motocicletas</option>
                    @foreach($maintenances->pluck('motorcycle')->unique() as $motorcycle)
                        <option value="{{ $motorcycle->idMotorcycle }}">
                            {{ $motorcycle->brand }} {{ $motorcycle->model }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Buscar:</label>
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar en diagnóstico...">
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de Mantenimientos -->
    <div class="items-grid" id="maintenancesGrid">
        @forelse($maintenances as $maintenance)
        <div class="item-card maintenance-card" 
             data-status="{{ $maintenance->status }}"
             data-motorcycle="{{ $maintenance->motorcycle->idMotorcycle }}"
             data-diagnosis="{{ strtolower($maintenance->diagnosis) }}">
            <div class="item-card-header">
                <h4 class="item-card-title">{{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</h4>
                <div class="item-card-icon">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
            
            <div class="mb-3">
                @if($maintenance->status == 0)
                    <span class="badge-custom badge-pending">{{ $maintenance->status_text }}</span>
                @elseif($maintenance->status == 1)
                    <span class="badge-custom badge-warning">{{ $maintenance->status_text }}</span>
                @elseif($maintenance->status == 2)
                    <span class="badge-custom badge-confirmed">{{ $maintenance->status_text }}</span>
                @else
                    <span class="badge-custom badge-cancelled">{{ $maintenance->status_text }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Fecha:</small>
                <p class="mb-1 fw-bold">{{ \Carbon\Carbon::parse($maintenance->maintenanceDate)->format('d/m/Y') }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Diagnóstico:</small>
                <p class="mb-1">{{ Str::limit($maintenance->diagnosis, 100) }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Mecánico:</small>
                <p class="mb-1">{{ $maintenance->mechanic->name ?? 'No asignado' }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Costo:</small>
                <p class="mb-1 fw-bold text-success">${{ number_format($maintenance->cost, 2) }}</p>
            </div>
            
            <button class="btn btn-primary-custom w-100" 
                    data-bs-toggle="modal" 
                    data-bs-target="#detallesMantenimientoModal"
                    data-maintenance="{{ $maintenance }}">
                <i class="fas fa-eye me-1"></i> Ver Detalles
            </button>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-tools empty-state-icon"></i>
                <h4 class="empty-state-title">No hay mantenimientos registrados</h4>
                <p class="empty-state-text">Los mantenimientos aparecerán aquí una vez que sean programados</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="pagination-custom">
            {{ $maintenances->links() }}
        </div>
    </div>
</div>

<!-- Modal Detalles (mantener igual) -->
<!-- ... -->

@endsection