@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Gestión de Ventas</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-store me-1"></i>
                <b>Ventas Registradas</b>
            </div>
            <a href="{{ route('sales.create') }}" class="btn btn-success btn-sm fw-bold">
                <i class="fas fa-plus"></i> Nueva Venta
            </a>
        </div>
        <div class="card-header">
            @if(session('success'))
                <p class="text-success">{{ session('success') }}</p>
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Productos</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Productos</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($sales as $key => $sale)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $sale->user->firstName ?? 'N/A' }} {{ $sale->user->lastName ?? '' }}</td>
                            <td>{{ $sale->saleDate->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($sale->total, 2) }} Bs.</td>
                            <td>{{ $sale->details->count() }} productos</td>
                            <td>{{ $sale->status == 1 ? 'Activa' : 'Inactiva' }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale->idSale) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('sales.edit', $sale->idSale) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('sales.destroy', $sale->idSale) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar venta?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection