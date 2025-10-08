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
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input list="userOptions" class="form-control" name="idUserSearch" id="idUserSearch" 
                                            placeholder="Escriba para buscar..." autocomplete="off">
                                        <datalist id="userOptions">
                                            @foreach($users as $user)
                                                <option value="{{ $user->firstName }} {{ $user->lastName }} ({{ $user->email }})" 
                                                        data-value="{{ $user->idUser }}">
                                            @endforeach
                                        </datalist>
                                        <input type="hidden" name="idUser" id="idUser">
                                        <label for="idUserSearch">Propietario</label>
                                    </div>
                                    <small class="text-muted">Escriba el nombre del propietario</small>
                                </div>
                            </div>

                            <script>
                            document.getElementById('idUserSearch').addEventListener('input', function() {
                                const searchValue = this.value;
                                const options = document.getElementById('userOptions').options;
                                const hiddenInput = document.getElementById('idUser');
                                
                                // Buscar coincidencia exacta
                                for (let option of options) {
                                    if (option.value === searchValue) {
                                        hiddenInput.value = option.getAttribute('data-value');
                                        return;
                                    }
                                }
                                
                                // Si no hay coincidencia, limpiar
                                hiddenInput.value = '';
                            });
                            </script>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="brand" type="text" 
                                               placeholder="Marca" value="{{ old('brand') }}" required />
                                        <label for="brand">Marca</label>
                                    </div>
                                    <small class="text-muted">Ejemplo: Yamaha, Honda</small>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="licensePlate" type="text" 
                                               placeholder="Placa" value="{{ old('licensePlate') }}" title="Formato de placa inválido" required />
                                        <label for="licensePlate">Placa</label>
                                    </div>
                                    <small class="text-muted">Ejemplo: ABC123 o 1234XYZ</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="model" type="text" 
                                               placeholder="Modelo" value="{{ old('model') }}" required />
                                        <label for="model">Modelo</label>
                                    </div>
                                    <small class="text-muted">Ejemplo: XTZ 250, CBR 600</small>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="year" type="number" 
                                               min="1900" max="{{ date('Y') + 1 }}" 
                                               placeholder="Año" value="{{ old('year') }}" required />
                                        <label for="year">Año</label>
                                    </div>
                                </div>
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