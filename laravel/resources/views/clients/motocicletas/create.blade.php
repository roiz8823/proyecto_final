@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-plus-circle me-2"></i>Registrar Nueva Motocicleta
                </h1>
                <p class="page-subtitle">Agrega una nueva motocicleta a tu perfil</p>
            </div>
            <a href="{{ route('cliente.motocicletas') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-motorcycle me-2"></i>Información de la Motocicleta
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cliente.motocicletas.store') }}" method="POST">
                        @csrf

                        <!-- Mensajes de éxito/error -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Marca -->
                            <div class="col-md-6 mb-3">
                                <label for="brand" class="form-label">Marca <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('brand') is-invalid @enderror" 
                                       id="brand" 
                                       name="brand" 
                                       value="{{ old('brand') }}" 
                                       placeholder="Ej: Honda, Yamaha, Suzuki"
                                       required>
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Modelo -->
                            <div class="col-md-6 mb-3">
                                <label for="model" class="form-label">Modelo <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('model') is-invalid @enderror" 
                                       id="model" 
                                       name="model" 
                                       value="{{ old('model') }}" 
                                       placeholder="Ej: CBR 600, MT-07, GSX-R750"
                                       required>
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Año -->
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Año <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('year') is-invalid @enderror" 
                                       id="year" 
                                       name="year" 
                                       value="{{ old('year') }}" 
                                       min="1900" 
                                       max="{{ date('Y') + 1 }}"
                                       placeholder="Ej: 2023"
                                       required>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Placa -->
                            <div class="col-md-6 mb-3">
                                <label for="licensePlate" class="form-label">Placa <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('licensePlate') is-invalid @enderror" 
                                       id="licensePlate" 
                                       name="licensePlate" 
                                       value="{{ old('licensePlate') }}" 
                                       placeholder="Ej: ABC-123"
                                       required>
                                @error('licensePlate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('cliente.motocicletas') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fas fa-save me-1"></i> Registrar Motocicleta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información Importante
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Marca y Modelo:</strong> Ingresa la información exacta de tu motocicleta
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Placa:</strong> Debe ser única y no estar registrada previamente
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Año:</strong> Año de fabricación de la motocicleta
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.form-label {
    font-weight: 600;
    color: #333;
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.card-header {
    border-bottom: 2px solid rgba(0,0,0,0.1);
}

.btn-primary-custom {
    background-color: #F9CD16;
    border-color: #F9CD16;
    color: #000000;
    font-weight: 600;
}

.btn-primary-custom:hover {
    background-color: transparent;
    color: #F9CD16;
    border-color: #F9CD16;
}
</style>
@endsection