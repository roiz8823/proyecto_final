<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Mantenimientos - Taller Izquierdo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .title { color: #2c3e50; font-size: 24px; margin-bottom: 5px; }
        .subtitle { color: #7f8c8d; font-size: 16px; }
        .stats { margin: 20px 0; }
        .stat-box { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 15px; margin: 10px 0; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table th { background-color: #2c3e50; color: white; padding: 10px; text-align: left; }
        .table td { padding: 8px; border: 1px solid #ddd; }
        .table tr:nth-child(even) { background-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: center; color: #7f8c8d; font-size: 12px; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: black; }
        .badge-info { background: #17a2b8; color: white; }
        .badge-secondary { background: #6c757d; color: white; }
        .text-right { text-align: right; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Mantenimientos</h1>
        <p class="subtitle">Taller Izquierdo - Generado el {{ $generatedAt }}</p>
    </div>

    <!-- Información del Reporte -->
    <div style="margin-bottom: 20px;">
        <p><strong>Generado por:</strong> {{ $generatedBy }}</p>
        @if($startDate || $endDate)
        <p><strong>Período:</strong> 
            {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Inicio' }} 
            - 
            {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Fin' }}
        </p>
        @endif
    </div>

    <!-- Estadísticas -->
    <div class="stats">
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #2c3e50;">{{ $totalMaintenances }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Total Mantenimientos</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #28a745;">${{ number_format($totalCost, 2) }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Costo Total</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #17a2b8;">{{ $byStatus['completed'] ?? 0 }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Completados</p>
            </div>
        </div>
    </div>

    <!-- Tabla de Mantenimientos -->
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Motocicleta</th>
                <th>Propietario</th>
                <th>Mecánico</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenances as $maintenance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($maintenance->maintenanceDate)->format('d/m/Y') }}</td>
                    <td>
                        <strong>{{ $maintenance->motorcycle->brand }}</strong> 
                        {{ $maintenance->motorcycle->model }}
                        <br>
                        <small>Placa: {{ $maintenance->motorcycle->licensePlate }}</small>
                    </td>
                    <td>
                        @if($maintenance->motorcycle->user)
                            {{ $maintenance->motorcycle->user->firstName }} {{ $maintenance->motorcycle->user->lastName }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($maintenance->mechanic)
                            {{ $maintenance->mechanic->firstName }} {{ $maintenance->mechanic->lastName }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ Str::limit($maintenance->diagnosis, 50) }}</td>
                    <td style="text-align: right;">${{ number_format($maintenance->cost, 2) }}</td>
                    <td>
                        @if($maintenance->status == 'completed')
                            <span class="badge badge-success">Completado</span>
                        @elseif($maintenance->status == 'in_progress')
                            <span class="badge badge-warning">En Progreso</span>
                        @elseif($maintenance->status == 'pending')
                            <span class="badge badge-info">Pendiente</span>
                        @else
                            <span class="badge badge-secondary">Cancelado</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($maintenances->count() == 0)
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p>No hay mantenimientos registrados</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>