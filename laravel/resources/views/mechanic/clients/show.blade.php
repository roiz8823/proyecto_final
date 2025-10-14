@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-motorcycle me-2"></i>Motocicletas de {{ $client->firstName }} {{ $client->lastName }}
            </h1>
        </div>
        <a href="{{ route('mechanic.clients.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <!-- Información básica del cliente -->
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-info text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-user-circle me-2"></i>Información del Cliente
            </h5>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="text-dark mb-1">{{ $client->firstName }} {{ $client->lastName }} {{ $client->secondLastName }}</h5>
                    <p class="mb-0">
                        <i class="fas fa-envelope text-primary me-1"></i>{{ $client->email }}
                        @if($client->phone)
                            | <i class="fas fa-phone text-primary me-1"></i>{{ $client->phone }}
                        @endif
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="badge bg-success fs-6 p-2">Cliente Activo</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de motocicletas -->
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Motocicletas Registradas
                </h5>
                <span class="badge bg-light text-primary fs-6">{{ $client->motorcycles->count() }} motos</span>
            </div>
        </div>
        <div class="card-body">
            @if($client->motorcycles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th class="bg-info">Marca</th>
                                <th class="bg-info">Modelo</th>
                                <th class="bg-info">Año</th>
                                <th class="bg-info">Placa</th>
                                <th class="bg-info">Estado</th>
                                <th class="bg-info">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($client->motorcycles as $motorcycle)
                                <tr class="align-middle">
                                    <td class="fw-bold text-dark">{{ $motorcycle->brand }}</td>
                                    <td>{{ $motorcycle->model }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $motorcycle->year }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark fs-6">{{ $motorcycle->licensePlate }}</span>
                                    </td>
                                    <td>
                                        @if($motorcycle->status == 1)
                                            <span class="badge bg-success p-2">Activa</span>
                                        @else
                                            <span class="badge bg-danger p-2">Inactiva</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('mechanic.motorcycles.show', $motorcycle->idMotorcycle) }}" 
                                            class="btn btn-info btn-sm shadow-sm" 
                                            title="Ver detalles">
                                                <i class="fas fa-eye"></i> Detalles
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-motorcycle fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted mb-3">No hay motocicletas registradas</h4>
                    <p class="text-muted mb-4">Este cliente no tiene motocicletas en el sistema.</p>
                    <a href="{{ route('mechanic.clients.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-1"></i> Volver a Clientes
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection