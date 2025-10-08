@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Detalles de la Motocicleta</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Propietario:</div>
                        <div class="col-md-8">{{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Marca:</div>
                        <div class="col-md-8">{{ $motorcycle->brand }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Modelo:</div>
                        <div class="col-md-8">{{ $motorcycle->model }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Año:</div>
                        <div class="col-md-8">{{ $motorcycle->year }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Placa:</div>
                        <div class="col-md-8">{{ $motorcycle->licensePlate }}</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('motorcycles.edit', $motorcycle->idMotorcycle) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('motorcycles.destroy', $motorcycle->idMotorcycle) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta motocicleta?')">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                        <a href="{{ route('motorcycles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection