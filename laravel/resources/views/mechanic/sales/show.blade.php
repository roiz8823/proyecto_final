@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-receipt me-2"></i>Detalles de la Venta
            </h1>
        </div>
        <a href="{{ route('mechanic.sales.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row">
        <!-- Información de la Venta -->
        <div class="col-md-6">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información de la Venta
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6 fw-bold text-muted">Número de Venta:</div>
                        <div class="col-6">#{{ $sale->idSale }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 fw-bold text-muted">Fecha:</div>
                        <div class="col-6">
                            <i class="fas fa-calendar text-primary me-1"></i>
                            {{ $sale->saleDate->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 fw-bold text-muted">Estado:</div>
                        <div class="col-6">
                            @if($sale->status == 1)
                                <span class="badge bg-success p-2">Activa</span>
                            @else
                                <span class="badge bg-secondary p-2">Inactiva</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del Cliente -->
        <div class="col-md-6">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Información del Cliente
                    </h5>
                </div>
                <div class="card-body">
                    @if($sale->user)
                        <div class="text-center mb-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white fa-lg"></i>
                            </div>
                            <h6 class="mb-1">{{ $sale->user->firstName }} {{ $sale->user->lastName }}</h6>
                        </div>
                        <div class="row">
                            <div class="col-4 fw-bold text-muted">Email:</div>
                            <div class="col-8">{{ $sale->user->email }}</div>
                        </div>
                        @if($sale->user->phone)
                        <div class="row mt-2">
                            <div class="col-4 fw-bold text-muted">Teléfono:</div>
                            <div class="col-8">{{ $sale->user->phone }}</div>
                        </div>
                        @endif
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>No hay información del cliente</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Detalles de la Venta -->
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Productos Vendidos
                <span class="badge bg-light text-dark ms-2">{{ $sale->details->count() }} productos</span>
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->details as $detail)
                            <tr>
                                <td>
                                    @if($detail->part)
                                        {{ $detail->part->name }}
                                    @else
                                        <span class="text-muted">Producto no disponible</span>
                                    @endif
                                </td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Bs {{ number_format($detail->unitPrice, 2) }}</td>
                                <td class="fw-bold text-success">Bs {{ number_format($detail->totalPrice, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-primary">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">TOTAL VENTA:</td>
                            <td class="fw-bold text-success fs-5">Bs {{ number_format($sale->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection