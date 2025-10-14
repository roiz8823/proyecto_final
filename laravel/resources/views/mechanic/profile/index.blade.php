@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-user-circle me-2"></i>Mi Perfil
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('mechanic.dashboard') }}">Dashboard</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Información del Perfil -->
        <div class="col-xl-8 col-lg-10 mx-auto">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card me-2"></i>Información Personal
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <div class="avatar-circle bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-user text-white fa-3x"></i>
                            </div>
                            <h5 class="fw-bold">{{ $user->firstName }} {{ $user->lastName }}</h5>
                            <span class="badge bg-success fs-6">{{ $user->role }}</span>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Nombre Completo:</label>
                                        <p class="fs-5">{{ $user->firstName }} {{ $user->lastName }} {{ $user->secondLastName ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Correo Electrónico:</label>
                                        <p class="fs-5">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Teléfono:</label>
                                        <p class="fs-5">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            {{ $user->phone ?? 'No registrado' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Rol:</label>
                                        <p class="fs-5">
                                            <span class="badge bg-primary p-2">{{ $user->role }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Dirección:</label>
                                        <p class="fs-5">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            {{ $user->address ?? 'No registrada' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Estado:</label>
                                        <p class="fs-5">
                                            @if($user->status)
                                                <span class="badge bg-success p-2">Activo</span>
                                            @else
                                                <span class="badge bg-danger p-2">Inactivo</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Fecha de Registro:</label>
                                        <p class="fs-5">
                                            <i class="fas fa-calendar-plus text-primary me-2"></i>
                                            {{ $user->registrationDate ? \Carbon\Carbon::parse($user->registrationDate)->format('d/m/Y') : 'No disponible' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted">Última Actualización:</label>
                                        <p class="fs-5">
                                            <i class="fas fa-calendar-check text-primary me-2"></i>
                                            {{ $user->updateDate ? \Carbon\Carbon::parse($user->updateDate)->format('d/m/Y') : 'No disponible' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection