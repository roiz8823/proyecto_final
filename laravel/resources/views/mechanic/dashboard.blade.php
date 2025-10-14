@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold ">Dashboard MECANICOS</h1>
    <h2 class="fw-bold">Bienvenido {{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h2>
    
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active ">Dashboard</li>
    </ol>

    <!-- Primera fila - 3 cards arriba -->
    <div class="row mb-4">
        <!-- Card Clientes -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
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
                    <a class="small text-white stretched-link" href="{{ route('mechanic.clients.index') }}">
                        Gestionar Clientes
                    </a>
                    <div class="small text-white">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Motocicletas -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
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
            <div class="card bg-primary text-white mb-4">
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
    </div>


    <!-- Tercera fila - 3 cards abajo -->
    <div class="row mb-4">
        <!-- Card Reservas -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
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
        <!-- Card Almacén -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
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
            <div class="card bg-primary text-white mb-4">
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
    </div>
</div>
@endsection