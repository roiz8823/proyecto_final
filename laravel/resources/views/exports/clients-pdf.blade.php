<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Clientes - Taller Izquierdo</title>
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
        .badge-secondary { background: #6c757d; color: white; }
        .badge-info { background: #17a2b8; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Clientes</h1>
        <p class="subtitle">Taller Izquierdo - Generado el {{ $generatedAt }}</p>
    </div>

    <!-- Información del Reporte -->
    <div style="margin-bottom: 20px;">
        <p><strong>Generado por:</strong> {{ $generatedBy }}</p>
    </div>

    <!-- Estadísticas -->
    <div class="stats">
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #2c3e50;">{{ $totalClients }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Total Clientes</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #28a745;">{{ $activeClients }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Clientes Activos</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #17a2b8;">{{ $clientsWithMotorcycles }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Con Motocicletas</p>
            </div>
        </div>
    </div>

    <!-- Tabla de Clientes -->
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Motocicletas</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->firstName }} {{ $client->lastName }} {{ $client->secondLastName ?? '' }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone ?? 'N/A' }}</td>
                    <td style="text-align: center;">
                        <span class="badge badge-info">{{ $client->motorcycles_count }}</span>
                    </td>
                    <td>
                        @if($client->status == 1)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        @if($client->registrationDate)
                            {{ \Carbon\Carbon::parse($client->registrationDate)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($clients->count() == 0)
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p>No hay clientes registrados</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>