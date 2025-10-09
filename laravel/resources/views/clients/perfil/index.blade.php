@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-user-circle me-2"></i>Mi Perfil
                </h1>
                <p class="page-subtitle">Gestiona tu información personal y motocicletas</p>
            </div>
            <a href="{{ route('cliente.perfil.edit') }}" class="btn btn-warning-custom">
                <i class="fas fa-edit me-1"></i> Editar Perfil
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Información Personal -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>Información Personal
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold" width="40%">Nombres:</td>
                                    <td>{{ $user->firstName }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Apellidos:</td>
                                    <td>{{ $user->lastName }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold" width="40%">Teléfono:</td>
                                    <td>{{ $user->phone ?? 'No registrado' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Dirección:</td>
                                    <td>{{ $user->address ?? 'No registrada' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mis Motocicletas -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-motorcycle me-2"></i>Mis Motocicletas
                        <span class="badge bg-light text-dark ms-2">{{ $motorcycles->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($motorcycles->count() > 0)
                        <div class="row">
                            @foreach($motorcycles as $motorcycle)
                            <div class="col-md-6 mb-3">
                                <div class="motorcycle-card p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold mb-0">{{ $motorcycle->brand }} {{ $motorcycle->model }}</h6>
                                        <span class="badge-custom badge-{{ $motorcycle->status_class }}">
                                            {{ $motorcycle->status_text }}
                                        </span>
                                    </div>
                                    <p class="mb-1 small">
                                        <i class="fas fa-tag me-1 text-muted"></i>
                                        {{ $motorcycle->licensePlate }}
                                    </p>
                                    <p class="mb-1 small">
                                        <i class="fas fa-calendar me-1 text-muted"></i>
                                        {{ $motorcycle->year }}
                                    </p>
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-tools me-1"></i>
                                            {{ $motorcycle->maintenances_count }} mant.
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-check me-1"></i>
                                            {{ $motorcycle->reservations_count }} res.
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-motorcycle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No tienes motocicletas registradas</p>
                            <a href="{{ route('cliente.motocicletas') }}" class="btn btn-primary-custom btn-sm">
                                <i class="fas fa-plus me-1"></i> Agregar Motocicleta
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.motorcycle-card {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.motorcycle-card:hover {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.badge-custom {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-confirmed {
    background-color: #d1edff;
    color: #0c5460;
}

.badge-cancelled {
    background-color: #f8d7da;
    color: #721c24;
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.card-header {
    border-bottom: 2px solid rgba(0,0,0,0.1);
}
</style>
@endsection