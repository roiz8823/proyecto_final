@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-bold">
                <i class="fas fa-chart-bar me-2"></i>Sistema de Reportes
            </h1>
        </div>
    </div>

    <!-- Tarjetas de Reportes Disponibles -->
    <div class="row">
        <!-- Reporte de Ventas -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Reporte de Ventas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Ventas del sistema</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('reports.sales') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reporte de Clientes -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Reporte de Clientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Clientes registrados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('reports.clients') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reporte de Motocicletas -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Reporte de Motocicletas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Inventario de motos</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-motorcycle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('reports.motorcycles') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reporte de Mantenimientos -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Reporte de Mantenimientos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Servicios realizados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('reports.maintenances') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reporte de Reservas -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Reporte de Reservas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Citas programadas</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('reports.reservations') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reporte de Inventario -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Reporte de Inventario
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Stock de repuestos</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('reports.inventory') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de Reportes Generados -->
    <div class="card shadow mt-4">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-history me-2"></i>Historial de Reportes Generados
            </h5>
        </div>
        <div class="card-body">
            @if($reports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Tipo de Reporte</th>
                                <th>Generado por</th>
                                <th>Fecha</th>
                                <th>Parámetros</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $report->formatted_type }}</span>
                                    </td>
                                    <td>{{ $report->user->firstName }} {{ $report->user->lastName }}</td>
                                    <td>{{ $report->registrationDate->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <small class="text-muted">
                                            @if($report->parameters)
                                                {{ json_encode($report->parameters) }}
                                            @else
                                                Sin parámetros
                                            @endif
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $reports->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay reportes generados</h5>
                    <p class="text-muted">Los reportes que generes aparecerán aquí.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection