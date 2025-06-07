@extends('admin.layouts.master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4 fw-bold">Crear Nueva Motocicleta</h3>
                    </div>
                    
                    <div class="card-header">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error:</strong> Corrige los siguientes campos:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('motorcycles.store') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="idUser" type="text" 
                                               placeholder="Propietario" value="{{ old('idUser') }}" required />
                                        <label for="idUser">Propietario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="licensePlate" type="text" 
                                               placeholder="Placa" value="{{ old('licensePlate') }}" required />
                                        <label for="licensePlate">Placa</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="brand" type="text" 
                                               placeholder="Marca" value="{{ old('brand') }}" required />
                                        <label for="brand">Marca</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="model" type="text" 
                                               placeholder="Modelo" value="{{ old('model') }}" required />
                                        <label for="model">Modelo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="year" type="number" 
                                               min="1900" max="{{ date('Y') + 1 }}" 
                                               placeholder="Año" value="{{ old('year') }}" required />
                                        <label for="year">Año</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="recommendations" id="recommendations" 
                                          style="height: 100px">{{ old('recommendations') }}</textarea>
                                <label for="recommendations">Recomendaciones/Mantenimiento</label>
                            </div>
                            
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-success btn-block" type="submit">
                                        <i class="fas fa-save me-1"></i> Registrar Motocicleta
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="card-footer text-center py-3">
                        <a href="{{ route('motorcycles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver al listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection