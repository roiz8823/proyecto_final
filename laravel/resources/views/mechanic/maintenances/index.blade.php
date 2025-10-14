@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-cog me-2"></i>Lista de Mantenimientos
            </h1>
        </div>
        <a href="{{ route('mechanic.maintenances.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Mantenimiento
        </a>
    </div>

    <div class="card shadow border-0">
        <!-- Card Header con color -->
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-tools me-2 fs-5"></i>
                    <h5 class="mb-0 fw-bold">Mantenimientos Registrados</h5>
                </div>
                <span class="badge bg-light text-primary fs-6">{{ $maintenances->count() }} registros</span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="bg-primary">Nro</th>
                            <th class="bg-primary">Motocicleta</th>
                            <th class="bg-primary">Fecha</th>
                            <th class="bg-primary">Diagnóstico</th>
                            <th class="bg-primary">Costo</th>
                            <th class="bg-primary">Estado</th>
                            <th class="bg-primary text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro</th>
                            <th>Motocicleta</th>
                            <th>Fecha</th>
                            <th>Diagnóstico</th>
                            <th>Costo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($maintenances as $key => $maintenance)
                            <tr class="align-middle">
                                <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                <td>
                                    @if($maintenance->motorcycle)
                                        <strong class="text-dark">{{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            {{ $maintenance->motorcycle->user->firstName ?? 'N/A' }}
                                        </small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-calendar text-muted me-1"></i>
                                    {{ $maintenance->maintenanceDate->format('d/m/Y') }}
                                </td>
                                <td>
                                    <span class="text-truncate" style="max-width: 200px; display: inline-block;">
                                        {{ $maintenance->diagnosis ?? 'Sin diagnóstico' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success fs-6">Bs {{ number_format($maintenance->cost, 2) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $maintenance->status_class }} p-2">
                                        {{ $maintenance->status_text }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mechanic.maintenances.show', $maintenance->idMaintenance) }}" 
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