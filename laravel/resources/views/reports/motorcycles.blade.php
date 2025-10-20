@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-motorcycle me-2"></i>Reporte de Motocicletas
            </h1>
        </div>
        <div>
            <a href="{{ route('exports.motorcycles.pdf', request()->all()) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf me-1"></i> Exportar PDF
            </a>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow mb-4">
        <div class="card-header bg-light py-3">
            <h5 class="mb-0">
                <i class="fas fa-filter me-2"></i>Filtros
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('reports.motorcycles') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Activas</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactivas</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand" 
                               value="{{ request('brand') }}" placeholder="Ej: Honda, Yamaha...">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('reports.motorcycles') }}" class="btn btn-secondary">
                        <i class="fas fa-undo me-1"></i> Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Motocicletas</h6>
                            <h3 class="mb-0">{{ $stats['total_motorcycles'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-motorcycle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Motocicletas Activas</h6>
                            <h3 class="mb-0">{{ $stats['active_motorcycles'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Marcas Diferentes</h6>
                            <h3 class="mb-0">{{ $stats['brands']->count() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tags fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Marcas Principales</h6>
                            <h5 class="mb-0">
                                @foreach($stats['brands']->take(2) as $brand => $count)
                                    {{ $brand }} ({{ $count }})@if(!$loop->last), @endif
                                @endforeach
                            </h5>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-star fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Motocicletas -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Lista de Motocicletas
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Placa</th>
                            <th>Propietario</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motorcycles as $motorcycle)
                            <tr>
                                <td class="fw-bold">{{ $motorcycle->brand }}</td>
                                <td>{{ $motorcycle->model }}</td>
                                <td>{{ $motorcycle->year }}</td>
                                <td>
                                    <span class="badge bg-dark">{{ $motorcycle->licensePlate }}</span>
                                </td>
                                <td>
                                    @if($motorcycle->user)
                                        {{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($motorcycle->status == 1)
                                        <span class="badge bg-success">Activa</span>
                                    @else
                                        <span class="badge bg-secondary">Inactiva</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($motorcycles->count() == 0)
                <div class="text-center py-5">
                    <i class="fas fa-motorcycle fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay motocicletas registradas</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection