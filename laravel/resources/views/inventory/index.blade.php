@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Inventario</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-table me-1"></i>
        <b>Repuestos Registrados </b>
    </div>
    <a href="#" class="btn btn-success btnsm fw-bold">
        <i class="fas fa-plus"></i>Agregar Repuesto
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
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $n = 1 ?>
                    @foreach ($inventorys as $inventory)
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td>{{ $inventory->name }}</td>
                            <td>{{ $inventory->category }}</td>
                            <td>{{ $inventory->price }}</td>
                            <td>{{ $inventory->stock }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm ">
                                    <i class="fas fa-edit">-</i> 
                                </a>
                                <form action="#" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('¿Eliminar usuario?')">
                                        <i class="fas fa-trash"></i>    
                                    </button>
                                </form>
                            </td>
                       </tr>
                       <?php $n = $n + 1; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
