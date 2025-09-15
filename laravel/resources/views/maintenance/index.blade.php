@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Gestión de Mantenimientos</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-tools me-1"></i>
                <b>Mantenimientos Registrados</b>
            </div>
            <a href="{{ route('maintenances.create') }}" class="btn btn-success btn-sm fw-bold">
                <i class="fas fa-plus"></i> Nuevo Mantenimiento
            </a>
        </div>
        
        <div class="card-header">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Mecánico</th>
                        <th>Diagnóstico</th>
                        <th>Fecha</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Mecánico</th>
                        <th>Diagnóstico</th>
                        <th>Fecha</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($maintenances as $key => $maintenance)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $maintenance->motorcycle->brand }} 
                            {{ $maintenance->motorcycle->model }}
                            <small class="text-muted d-block">{{ $maintenance->motorcycle->licensePlate }}</small>
                        </td>
                        <td>{{ $maintenance->mechanic->firstName ?? 'N/A' }}
                            {{ $maintenance->mechanic->lastName ?? 'N/A' }}
                            {{ $maintenance->mechanic->secondLastName ?? 'N/A' }}
                        </td>
                        <td>
                            <span title="{{ $maintenance->diagnosis }}">
                                {{ Str::limit($maintenance->diagnosis, 25) }}
                            </span>
                        </td>
                        <td>{{ $maintenance->maintenanceDate }}</td>
                        <td>{{ number_format($maintenance->cost, 2) }} Bs.</td>
                        <td>{{ $maintenance->status_text }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('maintenances.show', $maintenance, $maintenance->idMaintenance) }}" 
                                   class="btn btn-info btn-sm" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('maintenances.edit', $maintenance) }}" 
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('maintenances.destroy', $maintenance->idMaintenance) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            title="Eliminar"
                                            onclick="return confirm('¿Confirmas eliminar este mantenimiento?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($maintenances->isEmpty())
                <div class="alert alert-info text-center">
                    No se encontraron mantenimientos registrados
                </div>
            @endif
            
            
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesMaintenance').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            pageLength: 10
        });
    });
</script>
@endsection

@endsection