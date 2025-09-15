@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Editar Mantenimiento #{{ $maintenance->idMaintenance }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('maintenances.update', $maintenance->idMaintenance) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-select" name="idMotorcycle" id="idMotorcycle" required>
                                        @foreach($motorcycles as $motorcycle)
                                            <option value="{{ $motorcycle->idMotorcycle }}" 
                                                {{ $maintenance->idMotorcycle == $motorcycle->idMotorcycle ? 'selected' : '' }}>
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
                                        @foreach($mechanics as $mechanic)
                                            <option value="{{ $mechanic->idUser }}" 
                                                {{ $maintenance->idMechanic == $mechanic->idUser ? 'selected' : '' }}>
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
                                   value="{{ date('Y-m-d\TH:i', strtotime($maintenance->maintenanceDate)) }}" required />
                            <label for="maintenanceDate">Fecha y Hora</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" name="diagnosis" type="text" 
                                   placeholder="Diagnóstico" value="{{ $maintenance->diagnosis }}" required />
                            <label for="diagnosis">Diagnóstico</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="serviceDetails" id="serviceDetails" 
                                      style="height: 100px" required>{{ $maintenance->serviceDetails }}</textarea>
                            <label for="serviceDetails">Detalles del Servicio</label>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <textarea class="form-control" name="partsUsed" id="partsUsed" 
                                              style="height: 100px">{{ $maintenance->partsUsed }}</textarea>
                                    <label for="partsUsed">Partes Utilizadas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="cost" type="number" step="0.01" 
                                           placeholder="Costo" value="{{ $maintenance->cost }}" required />
                                    <label for="cost">Costo ($)</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-select" name="status" required>
                                        <option value="0" {{ $maintenance->status == 0 ? 'selected' : '' }}>Pendiente</option>
                                        <option value="1" {{ $maintenance->status == 1 ? 'selected' : '' }}>En Progreso</option>
                                        <option value="2" {{ $maintenance->status == 2 ? 'selected' : '' }}>Completado</option>
                                        <option value="3" {{ $maintenance->status == 3 ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                    <label for="status">Estado</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control" name="notes" id="notes" 
                                              style="height: 100px">{{ $maintenance->notes }}</textarea>
                                    <label for="notes">Notas Adicionales</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('maintenances.index') }}" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Actualizar Mantenimiento
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