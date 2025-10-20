@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-calendar-alt me-2"></i>Reporte de Reservas
            </h1>
        </div>
        <div>
            <a href="{{ route('exports.reservations.pdf', request()->all()) }}" class="btn btn-danger">
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
            <form method="GET" action="{{ route('reports.reservations') }}">
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
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completada</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('reports.reservations') }}" class="btn btn-secondary">
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
                            <h6 class="card-title">Total Reservas</h6>
                            <h3 class="mb-0">{{ $stats['total_reservations'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Confirmadas</h6>
                            <h3 class="mb-0">{{ $stats['confirmed_reservations'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Pendientes</h6>
                            <h3 class="mb-0">{{ $stats['pending_reservations'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Tasa de Confirmación</h6>
                            <h3 class="mb-0">{{ $stats['confirmation_rate'] }}%</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-percentage fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Reservas -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Lista de Reservas
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha Reserva</th>
                            <th>Cliente</th>
                            <th>Motocicleta</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($reservation->reservationDate)->format('d/m/Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($reservation->reservationTime)->format('h:i A') }}</small>
                                </td>
                                <td>
                                    @if($reservation->motorcycle && $reservation->motorcycle->user)
                                        {{ $reservation->motorcycle->user->firstName }} {{ $reservation->motorcycle->user->lastName }}
                                        <br>
                                        <small class="text-muted">{{ $reservation->motorcycle->user->email }}</small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($reservation->motorcycle)
                                        <strong>{{ $reservation->motorcycle->brand }}</strong> 
                                        {{ $reservation->motorcycle->model }}
                                        <br>
                                        <small class="text-muted">Placa: {{ $reservation->motorcycle->licensePlate }}</small>
                                    @else
                                        <span class="text-muted">Motocicleta no encontrada</span>
                                    @endif
                                </td>
                                <td>
                                    <span title="{{ $reservation->description }}">
                                        {{ Str::limit($reservation->notes, 50) }}
                                    </span>
                                </td>
                                <td>
                                    @if($reservation->status == 'confirmed')
                                        <span class="badge bg-success">Confirmada</span>
                                    @elseif($reservation->status == 'pending')
                                        <span class="badge bg-warning">Pendiente</span>
                                    @elseif($reservation->status == 'completed')
                                        <span class="badge bg-info">Completada</span>
                                    @else
                                        <span class="badge bg-secondary">Cancelada</span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($reservations->count() == 0)
                <div class="text-center py-5">
                    <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay reservas registradas</h5>
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
        type: 'doughnut',
        data: {
            labels: ['Confirmadas', 'Pendientes', 'Completadas', 'Canceladas'],
            datasets: [{
                data: [
                    {{ $stats['confirmed_reservations'] }},
                    {{ $stats['pending_reservations'] }},
                    {{ $stats['completed_reservations'] }},
                    {{ $stats['cancelled_reservations'] }}
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

    // Gráfico por tipo de servicio
    const serviceTypeCtx = document.getElementById('serviceTypeChart').getContext('2d');
    const serviceTypeChart = new Chart(serviceTypeCtx, {
        type: 'bar',
        data: {
            labels: ['Mantenimiento', 'Reparación', 'Inspección', 'Otro'],
            datasets: [{
                label: 'Cantidad',
                data: [
                    {{ $stats['maintenance_reservations'] }},
                    {{ $stats['repair_reservations'] }},
                    {{ $stats['inspection_reservations'] }},
                    {{ $stats['other_reservations'] }}
                ],
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