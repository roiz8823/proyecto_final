@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold">Gestión de Ventas</h1>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-store me-2"></i>Lista de Ventas
                </h5>
                <a href="{{ route('sales.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Nueva Venta
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nro Venta</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Productos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro Venta</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Productos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>#{{ $sale->idSale }}</td>
                                <td>
                                    @if($sale->user)
                                        {{ $sale->user->firstName }} {{ $sale->user->lastName }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $sale->saleDate->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="fw-bold text-success">${{ number_format($sale->total, 2) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $sale->details->count() }} productos</span>
                                </td>
                                <td>
                                    @if($sale->status == 1)
                                        <span class="badge bg-success">Activa</span>
                                    @else
                                        <span class="badge bg-secondary">Inactiva</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('sales.show', $sale->idSale) }}" 
                                           class="btn btn-info btn-sm" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.edit', $sale->idSale) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Editar venta">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sales.destroy', $sale->idSale) }}" 
                                              method="POST" 
                                              style="display:inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta venta?');">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm" 
                                                    title="Eliminar venta">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($sales->isEmpty())
                <div class="text-center py-4">
                    <i class="fas fa-store fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay ventas registradas</h5>
                    <p class="text-muted">Comienza creando una nueva venta</p>
                    <a href="{{ route('sales.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Crear Primera Venta
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection