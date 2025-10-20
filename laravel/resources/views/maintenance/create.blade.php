@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Registrar Nuevo Mantenimiento</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('maintenances.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-select" name="idMotorcycle" id="idMotorcycle" required>
                                        <option value="">Seleccione una motocicleta</option>
                                        @foreach($motorcycles as $motorcycle)
                                            <option value="{{ $motorcycle->idMotorcycle }}" {{ old('idMotorcycle') == $motorcycle->idMotorcycle ? 'selected' : '' }}>
                                                {{ $motorcycle->brand }} {{ $motorcycle->model }} ({{ $motorcycle->licensePlate }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="idMotorcycle">Motocicleta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="idMechanic" id="idMechanic" required>
                                        <option value="">Seleccione un mecánico</option>
                                        @foreach($mechanics as $mechanic)
                                            <option value="{{ $mechanic->idUser }}" {{ old('idMechanic') == $mechanic->idUser ? 'selected' : '' }}>
                                                {{ $mechanic->name }} {{ $mechanic->lastName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="idMechanic">Mecánico</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" name="maintenanceDate" type="datetime-local" 
                                   value="{{ old('maintenanceDate', date('Y-m-d\TH:i')) }}" required />
                            <label for="maintenanceDate">Fecha y Hora</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" name="diagnosis" type="text" 
                                   placeholder="Diagnóstico" value="{{ old('diagnosis') }}" required />
                            <label for="diagnosis">Diagnóstico</label>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <textarea class="form-control" name="partsUsed" id="partsUsed" 
                                              style="height: 100px">{{ old('partsUsed') }}</textarea>
                                    <label for="partsUsed">Partes Utilizadas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="cost" type="number" step="0.01" 
                                           placeholder="Costo" value="{{ old('cost') }}" required />
                                    <label for="cost">Costo (Bs)</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-select" name="status" required>
                                        <option value="0" {{ old('status', 0) == 0 ? 'selected' : '' }}>Pendiente</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>En Progreso</option>
                                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Completado</option>
                                        <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                    <label for="status">Estado</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save me-1"></i> Registrar Mantenimiento
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
