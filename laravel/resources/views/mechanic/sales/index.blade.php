@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-store me-2"></i>Lista de Ventas
            </h1>
        </div>
        <a href="{{ route('mechanic.sales.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nueva Venta
        </a>
    </div>

    <div class="card shadow border-0">
        <!-- Card Header con color -->
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-list me-2 fs-5"></i>
                    <h5 class="mb-0 fw-bold">Ventas Registradas</h5>
                </div>
                <span class="badge bg-light text-primary fs-6">{{ $sales->count() }} ventas</span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="bg-primary">Nro</th>
                            <th class="bg-primary">Cliente</th>
                            <th class="bg-primary">Fecha</th>
                            <th class="bg-primary">Productos</th>
                            <th class="bg-primary">Total</th>
                            <th class="bg-primary text-center">Acción</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($sales as $key => $sale)
                            <tr class="align-middle">
                                <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                <td>
                                    @if($sale->user)
                                        <strong class="text-dark">{{ $sale->user->firstName }} {{ $sale->user->lastName }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-envelope me-1"></i>{{ $sale->user->email }}
                                        </small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-calendar text-muted me-1"></i>
                                    {{ $sale->saleDate->format('d/m/Y') }}
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $sale->details->count() }} productos</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">Bs {{ number_format($sale->total, 2) }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mechanic.sales.show', $sale->idSale) }}" 
                                       class="btn btn-info btn-sm shadow-sm" 
                                       title="Ver detalles de la venta">
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