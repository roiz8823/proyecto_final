@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Almacén de Repuestos</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-warehouse me-1"></i>
                <b>Repuestos en Almacén</b>
            </div>
            <a href="{{ route('store.create') }}" class="btn btn-success btn-sm fw-bold">
                <i class="fas fa-plus"></i> Agregar Repuesto
            </a>
        </div>
        
        <div class="card-header">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filtros por categoría -->
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('store.index') }}" class="btn btn-outline-primary btn-sm">
                            Todos
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('store.byCategory', $category) }}" class="btn btn-outline-secondary btn-sm">
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <table id="datatablesStore" class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $key => $store)
                    <tr class="{{ $store->low_stock ? 'table-warning' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $store->name }}</td>
                        <td>
                            <span class="badge bg-info">{{ $store->category }}</span>
                        </td>
                        <td>{{ $store->formatted_price }}</td>
                        <td>
                            <span class="{{ $store->low_stock ? 'text-danger fw-bold' : '' }}">
                                {{ $store->stock }}
                                @if($store->low_stock)
                                    <i class="fas fa-exclamation-triangle" title="Stock bajo"></i>
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $store->status ? 'success' : 'secondary' }}">
                                {{ $store->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('store.show', $store->idPart) }}" 
                                   class="btn btn-info btn-sm" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('store.edit', $store->idPart) }}" 
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('store.updateStock', $store->idPart) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" name="stock" value="{{ $store->stock }}" 
                                           class="form-control form-control-sm d-inline" style="width: 80px;" 
                                           min="0" required>
                                    <button type="submit" class="btn btn-success btn-sm" title="Actualizar stock">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                                <form action="{{ route('store.destroy', $store->idPart) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            title="Eliminar"
                                            onclick="return confirm('¿Confirmas eliminar este repuesto?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($stores->isEmpty())
                <div class="alert alert-info text-center">
                    No se encontraron repuestos en el almacén
                </div>
            @endif
            
            <div class="d-flex justify-content-center mt-3">
                {{ $stores->links() }}
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesStore').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            pageLength: 10,
            order: [[1, 'asc']] // Ordenar por nombre
        });
    });
</script>
@endsection
@endsection