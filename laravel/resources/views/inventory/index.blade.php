@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Inventario</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                <b>Repuestos Registrados</b>
            </div>
            <a href="{{ route('inventory.create') }}" class="btn btn-success btn-sm fw-bold">
                <i class="fas fa-plus"></i> Agregar Repuesto
            </a>
        </div>
        <div class="card-header">
            @if(session('success'))
                <div class="alert alert-success mb-0">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventorys as $key => $inventory)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $inventory->name }}</td>
                            <td>{{ $inventory->category }}</td>
                            <td>{{ number_format($inventory->price, 2) }} Bs</td>
                            <td>{{ $inventory->stock }}</td>
                            <td>
                                @if($inventory->status == 1)
                                    <span class="badge bg-success">Disponible</span>
                                @elseif($inventory->status == 0)
                                    <span class="badge bg-danger">Agotado</span>
                                @else
                                    <span class="badge bg-warning">En Pedido</span>
                                @endif
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('inventory.show', $inventory->idPart) }}" class="btn btn-sm btn-primary" title="Ver">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                                <a href="{{ route('inventory.edit', $inventory->idPart) }}" 
                                   class="btn btn-warning btn-sm me-1"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('inventory.destroy', $inventory->idPart) }}" 
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este repuesto?')"
                                            title="Eliminar">
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