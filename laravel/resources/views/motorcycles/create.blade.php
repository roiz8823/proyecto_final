@extends('admin.layouts.master')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-4 fw-bold">
                            <i class="fas fa-motorcycle me-2"></i>Registrar Nueva Motocicleta
                        </h3>
                    </div>
                    
                    @if ($errors->any())
                    <div class="alert alert-danger mx-3 mt-3">
                        <strong><i class="fas fa-exclamation-circle me-2"></i>Error:</strong> Corrige los siguientes campos:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <div class="card-body">
                        <form action="{{ route('motorcycles.store') }}" method="POST" id="motorcycleForm">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-select" name="idUser" id="idUser" required>
                                            <option value="">Seleccione un propietario</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->idUser }}" {{ old('idUser') == $user->idUser ? 'selected' : '' }}>
                                                    {{ $user->firstName }} {{ $user->lastName }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="idUser">Propietario</label>
                                    </div>
                                    <small class="text-muted">Seleccione el dueño de la motocicleta</small>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="licensePlate" type="text" 
                                               placeholder="Placa" value="{{ old('licensePlate') }}" 
                                               pattern="[A-Z0-9]{6,8}" title="Formato de placa inválido" required />
                                        <label for="licensePlate">Placa</label>
                                    </div>
                                    <small class="text-muted">Ejemplo: ABC123 o 1234XYZ</small>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="brand" type="text" 
                                               placeholder="Marca" value="{{ old('brand') }}" required />
                                        <label for="brand">Marca</label>
                                    </div>
                                    <small class="text-muted">Ejemplo: Yamaha, Honda</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" name="model" type="text" 
                                               placeholder="Modelo" value="{{ old('model') }}" required />
                                        <label for="model">Modelo</label>
                                    </div>
                                    <small class="text-muted">Ejemplo: XTZ 250, CBR 600</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" name="year" type="number" 
                                               min="1900" max="{{ date('Y') + 1 }}" 
                                               placeholder="Año" value="{{ old('year') }}" required />
                                        <label for="year">Año</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="status" required>
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Activa</option>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactiva</option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>En Taller</option>
                                        </select>
                                        <label for="status">Estado</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="mileage" type="number" 
                                               placeholder="Kilometraje" value="{{ old('mileage', 0) }}" 
                                               min="0" step="1" />
                                        <label for="mileage">Kilometraje (km)</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="recommendations" id="recommendations" 
                                          style="height: 100px" placeholder="Recomendaciones">{{ old('recommendations') }}</textarea>
                                <label for="recommendations">Recomendaciones/Mantenimiento</label>
                                <small class="text-muted">Detalles importantes sobre el mantenimiento de la moto</small>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="specialNotes" id="specialNotes" 
                                          style="height: 80px" placeholder="Notas especiales">{{ old('specialNotes') }}</textarea>
                                <label for="specialNotes">Notas Especiales</label>
                                <small class="text-muted">Modificaciones, accesorios especiales, etc.</small>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('motorcycles.index') }}" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button class="btn btn-success" type="submit">
                                    <i class="fas fa-save me-1"></i> Registrar Motocicleta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@section('scripts')
<script>
    // Validación básica del formato de placa
    document.getElementById('motorcycleForm').addEventListener('submit', function(e) {
        const plate = document.getElementsByName('licensePlate')[0].value;
        if (!/^[A-Z0-9]{6,8}$/.test(plate)) {
            e.preventDefault();
            alert('El formato de la placa no es válido. Use solo letras mayúsculas y números (6-8 caracteres).');
        }
    });
</script>
@endsection

@endsection