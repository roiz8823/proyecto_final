@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-plus-circle me-2"></i>Nuevo Mantenimiento
            </h1>
        </div>
        <a href="{{ route('mechanic.maintenances.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-tools me-2"></i>Registrar Nuevo Mantenimiento
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('maintenances.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idMotorcycle" class="form-label fw-bold">Motocicleta *</label>
                            <select class="form-select @error('idMotorcycle') is-invalid @enderror" 
                                    id="idMotorcycle" name="idMotorcycle" required>
                                <option value="">Seleccionar Motocicleta</option>
                                @foreach($motorcycles as $motorcycle)
                                    <option value="{{ $motorcycle->idMotorcycle }}" 
                                        {{ old('idMotorcycle') == $motorcycle->idMotorcycle ? 'selected' : '' }}>
                                        {{ $motorcycle->brand }} {{ $motorcycle->model }} - 
                                        {{ $motorcycle->licensePlate }} ({{ $motorcycle->user->firstName }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idMotorcycle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="maintenanceDate" class="form-label fw-bold">Fecha de Mantenimiento *</label>
                            <input type="date" 
                                   class="form-control @error('maintenanceDate') is-invalid @enderror" 
                                   id="maintenanceDate" name="maintenanceDate" 
                                   value="{{ old('maintenanceDate', date('Y-m-d')) }}" 
                                   required>
                            @error('maintenanceDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label fw-bold">Diagnóstico *</label>
                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" 
                                      id="diagnosis" name="diagnosis" 
                                      rows="3" 
                                      placeholder="Describa el diagnóstico del problema..."
                                      required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="partsUsed" class="form-label fw-bold">Repuestos Utilizados</label>
                            <textarea class="form-control @error('partsUsed') is-invalid @enderror" 
                                      id="partsUsed" name="partsUsed" 
                                      rows="3" 
                                      placeholder="Lista de repuestos utilizados...">{{ old('partsUsed') }}</textarea>
                            @error('partsUsed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="cost" class="form-label fw-bold">Costo (Bs) *</label>
                            <div class="input-group">
                                <span class="input-group-text">Bs</span>
                                <input type="number" step="0.01" 
                                       class="form-control @error('cost') is-invalid @enderror" 
                                       id="cost" name="cost" 
                                       value="{{ old('cost') }}" 
                                       placeholder="0.00" 
                                       required>
                                @error('cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Estado *</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Pendiente</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>En Progreso</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Completado</option>
                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <a href="{{ route('mechanic.maintenances.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Mantenimiento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection