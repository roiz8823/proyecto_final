@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-center font-weight-light my-4">Detalles del Mantenimiento</h3>
                    <a href="{{ route('maintenances.export-pdf', $maintenance->idMaintenance) }}" 
                       class="btn btn-danger" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Información del Mantenimiento</h5>
                            <p><strong>Fecha:</strong> {{ date('d/m/Y H:i', strtotime($maintenance->maintenanceDate)) }}</p>
                            <p><strong>Estado:</strong> 
                                <span class="badge bg-{{ 
                                    $maintenance->status == 2 ? 'success' : 
                                    ($maintenance->status == 1 ? 'warning' : 
                                    ($maintenance->status == 3 ? 'danger' : 'secondary')) 
                                }}">
                                    {{ $maintenance->status_text }}
                                </span>
                            </p>
                            <p><strong>Costo:</strong> Bs {{ number_format($maintenance->cost, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Motocicleta</h5>
                            <p><strong>Marca/Modelo:</strong> {{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</p>
                            <p><strong>Placa:</strong> {{ $maintenance->motorcycle->licensePlate }}</p>
                            <p><strong>Dueño:</strong> {{ $maintenance->motorcycle->user->firstName ?? 'N/A'}} {{ $maintenance->motorcycle->user->lastName ?? '' }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Mecánico Asignado</h5>
                        <p>{{ $maintenance->mechanic->firstName ?? 'N/A' }} {{ $maintenance->mechanic->lastName ?? 'N/A' }}</p>
                        <p><strong>Contacto:</strong> {{ $maintenance->mechanic->phone ?? 'N/A' }} | {{ $maintenance->mechanic->email ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Diagnóstico</h5>
                        <p>{{ $maintenance->diagnosis ?? 'No especificado' }}</p>
                    </div>

                    @if($maintenance->partsUsed)
                    <div class="mb-4">
                        <h5>Partes Utilizadas</h5>
                        <p>{{ $maintenance->partsUsed }}</p>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('maintenances.edit', $maintenance->idMaintenance) }}" 
                               class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            <form action="{{ route('maintenances.destroy', $maintenance->idMaintenance) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este mantenimiento?')">
                                    <i class="fas fa-trash-alt me-1"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection