@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-box me-2"></i>Detalles del Producto
            </h1>
        </div>
        <a href="{{ route('mechanic.store.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-md-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información del Producto
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h3 class="text-dark mb-2">{{ $product->name }}</h3>
                            @if($product->category)
                                <span class="badge bg-primary fs-6">{{ $product->category }}</span>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="h2 text-success fw-bold">Bs {{ number_format($product->price, 2) }}</div>
                            <small class="text-muted">Precio unitario</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Estado:</label>
                                <p>
                                    @if($product->status)
                                        <span class="badge bg-success p-2">Activo</span>
                                    @else
                                        <span class="badge bg-danger p-2">Inactivo</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold text-muted">Fecha de Registro:</label>
                                <p>
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    {{ $product->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de Stock -->
        <div class="col-md-4">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-cubes me-2"></i>Control de Stock
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        @if($product->low_stock)
                            <div class="text-danger mb-3">
                                <i class="fas fa-exclamation-triangle fa-3x mb-2"></i>
                                <h5>Stock Bajo</h5>
                            </div>
                        @elseif($product->stock == 0)
                            <div class="text-secondary mb-3">
                                <i class="fas fa-times-circle fa-3x mb-2"></i>
                                <h5>Agotado</h5>
                            </div>
                        @else
                            <div class="text-success mb-3">
                                <i class="fas fa-check-circle fa-3x mb-2"></i>
                                <h5>Stock Disponible</h5>
                            </div>
                        @endif
                        
                        <div class="display-1 fw-bold 
                            {{ $product->low_stock ? 'text-warning' : '' }}
                            {{ $product->stock == 0 ? 'text-secondary' : 'text-primary' }}">
                            {{ $product->stock }}
                        </div>
                        <small class="text-muted">Unidades disponibles</small>
                    </div>

                    @if($product->low_stock)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Stock bajo. Considerar reabastecimiento.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen de Producto -->
    <div class="card shadow border-0">
        <div class="card-header bg-secondary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-chart-bar me-2"></i>Resumen del Producto
            </h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="border rounded p-3 bg-light">
                        <div class="h4 text-primary mb-0">{{ $product->stock }}</div>
                        <small class="text-muted">Stock Actual</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3 bg-light">
                        <div class="h4 text-success mb-0">Bs {{ number_format($product->price, 2) }}</div>
                        <small class="text-muted">Precio Unitario</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3 bg-light">
                        <div class="h4 text-info mb-0">
                            @if($product->status)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </div>
                        <small class="text-muted">Estado</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3 bg-light">
                        <div class="h4 text-warning mb-0">
                            @if($product->category)
                                {{ $product->category }}
                            @else
                                N/A
                            @endif
                        </div>
                        <small class="text-muted">Categoría</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection