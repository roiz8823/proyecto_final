@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-boxes me-2"></i>Reporte de Inventario
            </h1>
        </div>
        <div>
            <a href="{{ route('exports.inventory.pdf', request()->all()) }}" class="btn btn-danger">
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
            <form method="GET" action="{{ route('reports.inventory') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="category" class="form-label">Categoría</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Todas</option>
                            <option value="parts" {{ request('category') == 'parts' ? 'selected' : '' }}>Repuestos</option>
                            <option value="accessories" {{ request('category') == 'accessories' ? 'selected' : '' }}>Accesorios</option>
                            <option value="tools" {{ request('category') == 'tools' ? 'selected' : '' }}>Herramientas</option>
                            <option value="lubricants" {{ request('category') == 'lubricants' ? 'selected' : '' }}>Lubricantes</option>
                            <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Otros</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="stock_status" class="form-label">Estado de Stock</label>
                        <select class="form-select" id="stock_status" name="stock_status">
                            <option value="">Todos</option>
                            <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Stock Bajo</option>
                            <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Sin Stock</option>
                            <option value="normal" {{ request('stock_status') == 'normal' ? 'selected' : '' }}>Stock Normal</option>
                        </select>
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
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('reports.inventory') }}" class="btn btn-secondary">
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
                            <h6 class="card-title">Total Productos</h6>
                            <h3 class="mb-0">{{ $stats['total_products'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-box fa-2x opacity-50"></i>
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
                            <h6 class="card-title">Valor Total</h6>
                            <h3 class="mb-0">Bs {{ number_format($stats['total_value'], 2) }}</h3>
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
                            <h6 class="card-title">Stock Bajo</h6>
                            <h3 class="mb-0">{{ $stats['low_stock'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Sin Stock</h6>
                            <h3 class="mb-0">{{ $stats['out_of_stock'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-times-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos con Stock Bajo -->
    @if($stats['low_stock_products']->count() > 0)
    <div class="card shadow mb-4 border-warning">
        <div class="card-header bg-warning text-dark py-3">
            <h5 class="mb-0">
                <i class="fas fa-exclamation-triangle me-2"></i>Productos con Stock Bajo
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock Actual</th>
                            <th>Stock Mínimo</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['low_stock_products'] as $product)
                            <tr>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($product->description, 30) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $product->category }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning">{{ $product->stock }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $product->minStock ?? 10 }}</span>
                                </td>
                                <td>
                                    <strong>Bs {{ number_format($product->price, 2) }}</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Tabla de Inventario Completo -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Inventario Completo
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio Venta</th>
                            <th>Valor Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($product->description, 30) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $product->category }}</span>
                                </td>
                                <td>
                                    @if($product->stock == 0)
                                        <span class="badge bg-danger">{{ $product->stock }}</span>
                                    @elseif($product->stock < 10)
                                        <span class="badge bg-warning">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>Bs {{ number_format($product->price, 2) }}</strong>
                                </td>
                                <td>
                                    <strong>Bs {{ number_format($product->stock * $product->price, 2) }}</strong>
                                </td>
                                <td>
                                    @if($product->stock == 0)
                                        <span class="badge bg-danger">Sin Stock</span>
                                    @elseif($product->stock < 10)
                                        <span class="badge bg-warning">Stock Bajo</span>
                                    @else
                                        <span class="badge bg-success">Disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($products->count() == 0)
                <div class="text-center py-5">
                    <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay productos en el inventario</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de distribución por categoría
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($stats['categories']->keys()) !!},
            datasets: [{
                data: {!! json_encode($stats['categories']->values()) !!},
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d']
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

    // Gráfico de estado de stock
    const stockCtx = document.getElementById('stockChart').getContext('2d');
    const stockChart = new Chart(stockCtx, {
        type: 'bar',
        data: {
            labels: ['Stock Normal', 'Stock Bajo', 'Sin Stock'],
            datasets: [{
                label: 'Cantidad de Productos',
                data: [
                    {{ $stats['total_products'] - $stats['low_stock'] - $stats['out_of_stock'] }},
                    {{ $stats['low_stock'] }},
                    {{ $stats['out_of_stock'] }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
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