@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detalles de Venta</h1>
    
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
        <li class="breadcrumb-item active">Venta #{{ $sale->idSale }}</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-eye me-2"></i>Detalles de Venta #{{ $sale->idSale }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6>Información de la Venta</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>Número de Venta:</th>
                            <td>#{{ $sale->idSale }}</td>
                        </tr>
                        <tr>
                            <th>Fecha:</th>
                            <td>{{ $sale->saleDate->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td class="fw-bold text-success">${{ number_format($sale->total, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                @if($sale->status == 1)
                                    <span class="badge bg-success">Activa</span>
                                @else
                                    <span class="badge bg-secondary">Inactiva</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <h6>Información de los Participantes</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>Cliente:</th>
                            <td>
                                @if($sale->user)
                                    {{ $sale->user->firstName }} {{ $sale->user->lastName }}
                                    <br><small class="text-muted">{{ $sale->user->email }}</small>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Mecánico:</th>
                            <td>
                                @if($sale->mechanic)
                                    {{ $sale->mechanic->firstName }} {{ $sale->mechanic->lastName }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Detalles de la venta -->
            <h6>Productos Vendidos</h6>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
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
                                        {{ $detail->part->partName }}
                                    @else
                                        <span class="text-muted">Producto no disponible</span>
                                    @endif
                                </td>
                                <td>{{ $detail->quantity }}</td>
                                <td>${{ number_format($detail->unitPrice, 2) }}</td>
                                <td class="fw-bold">${{ number_format($detail->totalPrice, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">TOTAL:</td>
                            <td class="fw-bold text-success">${{ number_format($sale->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary me-md-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('sales.edit', $sale->idSale) }}" class="btn btn-warning me-md-2">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection