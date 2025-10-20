@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-tools me-2"></i>Reporte de Mantenimientos
            </h1>
        </div>
        <div>
            <a href="{{ route('exports.maintenances.pdf', request()->all()) }}" class="btn btn-danger">
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
            <form method="GET" action="{{ route('reports.maintenances') }}">
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
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completado</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                     <!-- COMENTADO 
                    <div class="col-md-3">
                        <label for="mechanic_id" class="form-label">Mecánico</label>
                        <select class="form-select" id="mechanic_id" name="mechanic_id">
                            <option value="">Todos</option>
                            @foreach($mechanics as $mechanic)
                                <option value="{{ $mechanic->id }}" {{ request('mechanic_id') == $mechanic->id ? 'selected' : '' }}>
                                    {{ $mechanic->firstName }} {{ $mechanic->lastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    -->
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('reports.maintenances') }}" class="btn btn-secondary">
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
                            <h6 class="card-title">Total Mantenimientos</h6>
                            <h3 class="mb-0">{{ $stats['total_maintenances'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tools fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Completados</h6>
                            <h3 class="mb-0">{{ $stats['completed_maintenances'] }}</h3>
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
                            <h6 class="card-title">Costo Total</h6>
                            <h3 class="mb-0">Bs {{ number_format($stats['total_cost'], 2) }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-dollar-sign fa-2x opacity-50"></i>
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
                            <h6 class="card-title">En Progreso</h6>
                            <h3 class="mb-0">{{ $stats['in_progress_maintenances'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Mantenimientos -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Lista de Mantenimientos
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Motocicleta</th>
                            <th>Propietario</th>
                            <th>Mecánico</th>
                            <th>Costo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maintenances as $maintenance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($maintenance->maintenanceDate)->format('d/m/Y') }}</td>
                                <td>
                                    <strong>{{ $maintenance->motorcycle->brand }}</strong> 
                                    {{ $maintenance->motorcycle->model }}
                                    <br>
                                    <small class="text-muted">Placa: {{ $maintenance->motorcycle->licensePlate }}</small>
                                </td>
                                <td>
                                    @if($maintenance->motorcycle->user)
                                        {{ $maintenance->motorcycle->user->firstName }} {{ $maintenance->motorcycle->user->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($maintenance->mechanic)
                                        {{ $maintenance->mechanic->firstName }} {{ $maintenance->mechanic->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>${{ number_format($maintenance->cost, 2) }}</strong>
                                </td>
                                <td>
                                    @if($maintenance->status == 'completed')
                                        <span class="badge bg-success">Completado</span>
                                    @elseif($maintenance->status == 'in_progress')
                                        <span class="badge bg-warning">En Progreso</span>
                                    @elseif($maintenance->status == 'pending')
                                        <span class="badge bg-info">Pendiente</span>
                                    @else
                                        <span class="badge bg-secondary">Cancelado</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($maintenances->count() == 0)
                <div class="text-center py-5">
                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay mantenimientos registrados</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de distribución por estado
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Completados', 'En Progreso', 'Pendientes', 'Cancelados'],
            datasets: [{
                data: [
                    {{ $stats['completed_maintenances'] }},
                    {{ $stats['in_progress_maintenances'] }},
                    {{ $stats['pending_maintenances'] }},
                    {{ $stats['cancelled_maintenances'] }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#17a2b8', '#6c757d']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Gráfico de mantenimientos por mecánico
    const mechanicCtx = document.getElementById('mechanicChart').getContext('2d');
    const mechanicChart = new Chart(mechanicCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats['mechanics']->pluck('name')) !!},
            datasets: [{
                label: 'Mantenimientos',
                data: {!! json_encode($stats['mechanics']->pluck('count')) !!},
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush