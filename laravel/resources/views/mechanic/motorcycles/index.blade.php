@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-motorcycle me-2"></i>Lista de Motocicletas
            </h1>
        </div>
    </div>

    <div class="card shadow border-0">
        <!-- Card Header con color -->
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bars me-2 fs-5"></i>
                    <h5 class="mb-0 fw-bold">Motocicletas Registradas</h5>
                </div>
                <span class="badge bg-light text-primary fs-6">{{ $motorcycles->count() }} motos</span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="bg-primary">Nro</th>
                            <th class="bg-primary">Marca</th>
                            <th class="bg-primary">Modelo</th>
                            <th class="bg-primary">Año</th>
                            <th class="bg-primary">Placa</th>
                            <th class="bg-primary">Propietario</th>
                            <th class="bg-primary text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Placa</th>
                            <th>Propietario</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($motorcycles as $key => $motorcycle)
                            <tr class="align-middle">
                                <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                <td>
                                    <strong class="text-dark">{{ $motorcycle->brand }}</strong>
                                </td>
                                <td>{{ $motorcycle->model }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $motorcycle->year }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-dark">{{ $motorcycle->licensePlate }}</span>
                                </td>
                                <td>
                                    @if($motorcycle->user)
                                        <i class="fas fa-user text-muted me-1"></i>
                                        {{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mechanic.motorcycles.show', $motorcycle->idMotorcycle) }}" 
                                           class="btn btn-info btn-sm shadow-sm" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    </div>
                                </td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection