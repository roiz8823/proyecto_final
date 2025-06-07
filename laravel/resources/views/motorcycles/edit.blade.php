@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4 fw-bold">Editar Motocicleta</h3>
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
                    <form action="{{ route('motorcycles.update', $motorcycle) }}" method="POST">
                        @csrf @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="idUser" type="text" 
                                           placeholder="Placa" value="{{ old('idUser', $motorcycle->idUser) }}" required />
                                    <label for="idUser">Propietario</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="licensePlate" type="text" 
                                           placeholder="Placa" value="{{ old('licensePlate', $motorcycle->licensePlate) }}" required />
                                    <label for="licensePlate">Placa</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="brand" type="text" 
                                           placeholder="Marca" value="{{ old('brand', $motorcycle->brand) }}" required />
                                    <label for="brand">Marca</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="model" type="text" 
                                           placeholder="Modelo" value="{{ old('model', $motorcycle->model) }}" required />
                                    <label for="model">Modelo</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="year" type="number" 
                                           min="1900" max="{{ date('Y') + 1 }}" 
                                           placeholder="Año" value="{{ old('year', $motorcycle->year) }}" required />
                                    <label for="year">Año</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ old('status', $motorcycle->status) == 1 ? 'selected' : '' }}>Activa</option>
                                        <option value="0" {{ old('status', $motorcycle->status) == 0 ? 'selected' : '' }}>Inactiva</option>
                                    </select>
                                    <label for="status">Estado</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="recommendations" id="recommendations" 
                                      style="height: 100px">{{ old('recommendations', $motorcycle->recommendations) }}</textarea>
                            <label for="recommendations">Recomendaciones/Mantenimiento</label>
                        </div>
                        
                        <div class="mt-4 mb-0">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('motorcycles.index') }}" class="btn btn-danger me-md-2">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </a>
                                <button class="btn btn-warning" type="submit">
                                    <i class="fas fa-save me-1"></i> Actualizar Motocicleta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection