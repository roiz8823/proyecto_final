@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="fw-bold">Detalles del Repuesto</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Información del Repuesto</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">ID:</th>
                            <td>{{ $store->idPart }}</td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $store->name }}</td>
                        </tr>
                        <tr>
                            <th>Categoría:</th>
                            <td>
                                <span class="badge bg-info">{{ $store->category }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Precio:</th>
                            <td class="fw-bold">{{ $store->formatted_price }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <h5>Inventario y Estado</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Stock Actual:</th>
                            <td>
                                <span class="{{ $store->low_stock ? 'text-danger fw-bold' : '' }}">
                                    {{ $store->stock }} unidades
                                    @if($store->low_stock)
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <span class="badge bg-{{ $store->status ? 'success' : 'secondary' }}">
                                    {{ $store->status_text }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha Registro:</th>
                            <td>{{ $store->registrationDate->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Última Actualización:</th>
                            <td>{{ $store->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Actualización rápida de stock -->
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Actualizar Stock</h5>
                    <form action="{{ route('store.updateStock', $store->idPart) }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-4">
                            <label for="stock" class="form-label">Nuevo Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" 
                                   value="{{ $store->stock }}" min="0" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success d-block">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('store.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Almacén
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('store.edit', $store->idPart) }}" 
                       class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('store.destroy', $store->idPart) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar este repuesto?')">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection