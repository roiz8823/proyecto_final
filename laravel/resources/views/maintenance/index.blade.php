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
                <p class="text-success">{{ session('success') }}</p>
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Mecánico</th>
                        <th>Fecha</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Mecánico</th>
                        <th>Fecha</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($maintenances as $key => $maintenance)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}<br>
                                {{ $maintenance->motorcycle->licensePlate }}
                            </td>
                            <td>{{ $maintenance->mechanic->firstName ?? 'N/A' }} {{ $maintenance->mechanic->lastName ?? '' }}</td>
                            <td>{{ $maintenance->maintenanceDate }}</td>
                            <td>{{ number_format($maintenance->cost, 2) }} Bs.</td>
                            <td>{{ $maintenance->status_text }}</td>
                            <td>
                                <a href="{{ route('maintenances.show', $maintenance->idMaintenance) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('maintenances.edit', $maintenance->idMaintenance) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('maintenances.destroy', $maintenance->idMaintenance) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar mantenimiento?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection