@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold">Dashboard ADMINISTRADORES</h1>
    <h2>Bienvenido {{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h2>
    
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- Primera fila - 3 cards arriba -->
    <div class="row mb-4">
        <!-- Card Usuarios -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Gestión de usuarios del sistema</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('users.index') }}">
                        Gestionar Usuarios
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Clientes -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-user-circle fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">Administración de clientes</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/clients">
                        Gestionar Clientes
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Mecánicos -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-wrench fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Mecánicos</h5>
                        <p class="card-text">Gestión del personal técnico</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/mechanic">
                        Gestionar Mecánicos
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda fila - 3 cards en medio -->
    <div class="row mb-4">
        <!-- Card Motocicletas -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-motorcycle fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Motocicletas</h5>
                        <p class="card-text">Inventario de motocicletas</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('motorcycles.index') }}">
                        Ver Motocicletas
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Mantenimientos -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-cog fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Mantenimientos</h5>
                        <p class="card-text">Control de mantenimientos</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/maintenances">
                        Ver Mantenimientos
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Reservas -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Reservas</h5>
                        <p class="card-text">Gestión de reservas y citas</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('reservations.index') }}">
                        Ver Reservas
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tercera fila - 3 cards abajo -->
    <div class="row mb-4">
        <!-- Card Almacén -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-warehouse fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Almacén</h5>
                        <p class="card-text">Gestión de inventario</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('store.index') }}">
                        Ir al Almacén
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Ventas -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-store fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Ventas</h5>
                        <p class="card-text">Módulo de ventas</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('sales.index') }}">
                        Ir a Ventas
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Reportes -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-file-alt fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Reportes y estadísticas</p>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.html">
                        Ver Reportes
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection