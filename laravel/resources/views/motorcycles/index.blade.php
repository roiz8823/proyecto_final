@extends('admin.layouts.master')


@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Lista de Motocicletas</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-motorcycle me-1"></i>
        <b>Motocicletas Registradas </b>
    </div>
    <a href="{{ route('motorcycles.create') }}" class="btn btn-success mb-3 fw-bold">
        <i class="fas fa-plus"></i> Nueva Motocicleta
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
                        <th>Propietario</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Placa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Propietario</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Placa</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($motorcycles as $key => $motorcycle)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $motorcycle->user->firstName ?? 'N/A' }} 
                                {{ $motorcycle->user->lastName ?? '' }}
                            </td>
                            <td>{{ $motorcycle->brand }}</td>
                            <td>{{ $motorcycle->model }}</td>
                            <td>{{ $motorcycle->year }}</td>
                            <td>{{ $motorcycle->licensePlate }}</td>
                            <td>
                                <a href="{{ route('motorcycles.show', $motorcycle->idMotorcycle) }}" class="btn btn-sm btn-primary" title="Ver">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                                <a href="{{ route('motorcycles.edit', $motorcycle->idMotorcycle) }}" 
                                class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('motorcycles.destroy', $motorcycle->idMotorcycle) }}" 
                                    method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                                            onclick="return confirm('¿Estás seguro de eliminar esta motocicleta?')">
                                        <i class="fas fa-trash-alt"></i>
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

