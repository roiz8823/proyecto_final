@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-warehouse me-2"></i>Inventario de Almacén
            </h1>
        </div>
    </div>

    <!-- Filtros por Categoría -->
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-light py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-filter me-2"></i>Filtrar por Categoría
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('mechanic.store.index') }}" 
                   class="btn btn-outline-primary {{ !request()->segment(3) ? 'active' : '' }}">
                    <i class="fas fa-list me-1"></i> Todas las Categorías
                </a>
                @foreach($categories as $category)
                    @if($category)
                        <a href="{{ route('mechanic.store.category', $category) }}" 
                           class="btn btn-outline-primary {{ request()->segment(3) == $category ? 'active' : '' }}">
                            <i class="fas fa-tag me-1"></i> {{ $category }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <!-- Card Header con color -->
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-boxes me-2 fs-5"></i>
                    <h5 class="mb-0 fw-bold">
                        @if(request()->segment(3))
                            Productos - {{ request()->segment(3) }}
                        @else
                            Todos los Productos
                        @endif
                    </h5>
                </div>
                <span class="badge bg-light text-primary fs-6">{{ $products->count() }} productos</span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="bg-primary">Nro</th>
                            <th class="bg-primary">Nombre</th>
                            <th class="bg-primary">Categoría</th>
                            <th class="bg-primary">Stock</th>
                            <th class="bg-primary">Precio</th>
                            <th class="bg-primary text-center">Acción</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr class="align-middle">
                                <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                <td>
                                    <strong class="text-dark">{{ $product->name }}</strong>
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge bg-info">{{ $product->category }}</span>
                                    @else
                                        <span class="text-muted">Sin categoría</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->low_stock)
                                        <span class="badge bg-danger p-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $product->stock }}
                                        </span>
                                    @elseif($product->stock == 0)
                                        <span class="badge bg-secondary p-2">
                                            <i class="fas fa-times me-1"></i>
                                            Agotado
                                        </span>
                                    @else
                                        <span class="badge bg-success p-2">
                                            <i class="fas fa-check me-1"></i>
                                            {{ $product->stock }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-success">Bs {{ number_format($product->price, 2) }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mechanic.store.show', $product->idPart) }}" 
                                       class="btn btn-info btn-sm shadow-sm" 
                                       title="Ver detalles del producto">
                                        <i class="fas fa-eye me-1"></i> Ver
                                    </a>
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