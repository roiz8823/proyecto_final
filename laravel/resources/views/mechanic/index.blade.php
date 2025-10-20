@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Lista de Mecanicos</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-wrench me-1"></i>
        <b>Mecanicos Registrados </b>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-success btnsm fw-bold">
        <i class="fas fa-plus"></i>Crear Mecanico
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
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->firstName }} {{ $user->lastName}} </br>
                                {{ $user->email }}
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <a href="{{ route('motorcycles.index') }}" class="btn btn-primary btn-sm ">
                                    <i class="fas fa-motorcycle"></i>
                                </a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm ">
                                    <i class="fas fa-edit">-</i> 
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('¿Eliminar usuario?')">
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
