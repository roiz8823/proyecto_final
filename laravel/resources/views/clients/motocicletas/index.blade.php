@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-motorcycle me-2"></i>Mis Motocicletas
        </h1>
        <p class="page-subtitle">Gestiona todas tus motocicletas registradas en el taller</p>
    </div>

    <!-- Estadísticas -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number">{{ $motorcycles->count() }}</div>
            <div class="stat-label">Total Motocicletas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $motorcycles->where('status', 1)->count() }}</div>
            <div class="stat-label">Activas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $motorcycles->sum('reservations_count') }}</div>
            <div class="stat-label">Total Reservas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $motorcycles->sum('maintenances_count') }}</div>
            <div class="stat-label">Total Mantenimientos</div>
        </div>
    </div>

    <!-- Grid de Motocicletas -->
    <div class="items-grid">
        @forelse($motorcycles as $motorcycle)
        <div class="item-card">
            <div class="item-card-header">
                <h4 class="item-card-title">{{ $motorcycle->brand }} {{ $motorcycle->model }}</h4>
                <div class="item-card-icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
            </div>
            
            <div class="mb-3">
                @if($motorcycle->status)
                    <span class="badge-custom badge-confirmed">Activa</span>
                @else
                    <span class="badge-custom badge-cancelled">Inactiva</span>
                @endif
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Placa:</small>
                <p class="mb-1 fw-bold text-primary">{{ $motorcycle->licensePlate }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Año:</small>
                <p class="mb-1">{{ $motorcycle->year }}</p>
            </div>
            
            <!-- Estadísticas de la motocicleta -->
            <div class="row text-center mb-3">
                <div class="col-6">
                    <div class="border rounded p-2 bg-light">
                        <h6 class="mb-0 text-primary">{{ $motorcycle->reservations_count }}</h6>
                        <small class="text-muted">Reservas</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="border rounded p-2 bg-light">
                        <h6 class="mb-0 text-success">{{ $motorcycle->maintenances_count }}</h6>
                        <small class="text-muted">Mantenimientos</small>
                    </div>
                </div>
            </div>

            @if($motorcycle->recommendations)
            <div class="alert alert-warning-custom small mb-3">
                <strong><i class="fas fa-info-circle me-1"></i>Recomendaciones:</strong><br>
                {{ Str::limit($motorcycle->recommendations, 100) }}
            </div>
            @endif

            <a href="{{ route('cliente.motocicletas.show', $motorcycle->idMotorcycle) }}" 
               class="btn btn-primary-custom w-100">
                <i class="fas fa-eye me-1"></i> Ver Detalles Completos
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-motorcycle empty-state-icon"></i>
                <h4 class="empty-state-title">No tienes motocicletas registradas</h4>
                <p class="empty-state-text">Contacta con el administrador para registrar tu primera motocicleta</p>
                <a href="#" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-1"></i> Solicitar Registro
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection