 @extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-dollar-sign me-2"></i>Reporte de Ventas
            </h1>
        </div>
        <div>
            <a href="{{ route('exports.sales.pdf', request()->all()) }}" class="btn btn-danger">
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
            <form method="GET" action="{{ route('reports.sales') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Activas</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactivas</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('reports.sales') }}" class="btn btn-secondary">
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
                            <h6 class="card-title">Total Ventas</h6>
                            <h3 class="mb-0">{{ $totalSales }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Ingreso Total</h6>
                            <h3 class="mb-0">Bs {{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-dollar-sign fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Promedio por Venta</h6>
                            <h3 class="mb-0">Bs {{ number_format($averageSale, 2) }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-line fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Período</h6>
                            <h5 class="mb-0">
                                @if(request('start_date') && request('end_date'))
                                    {{ request('start_date') }} a {{ request('end_date') }}
                                @else
                                    Todo el período
                                @endif
                            </h5>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Ventas -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Detalle de Ventas
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th># Venta</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td class="fw-bold">#{{ $sale->idSale }}</td>
                                <td>
                                    @if($sale->user)
                                        {{ $sale->user->firstName }} {{ $sale->user->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $sale->saleDate->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $sale->details->count() }} productos</span>
                                </td>
                                <td class="fw-bold text-success">Bs {{ number_format($sale->total, 2) }}</td>
                                <td>
                                    @if($sale->status == 1)
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

            @if($sales->count() == 0)
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay ventas en el período seleccionado</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection