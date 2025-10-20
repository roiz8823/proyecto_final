<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Motocicletas - Taller Izquierdo</title>
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
        .badge-dark { background: #343a40; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Motocicletas</h1>
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
                <h3 style="margin: 0; color: #2c3e50;">{{ $totalMotorcycles }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Total Motocicletas</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #28a745;">{{ $activeMotorcycles }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Motocicletas Activas</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #17a2b8;">{{ $brands->count() }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Marcas Diferentes</p>
            </div>
        </div>
    </div>

    <!-- Distribución por Marcas -->
    <div style="margin: 20px 0;">
        <h3 style="color: #2c3e50;">Distribución por Marcas</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="background: #f8f9fa; padding: 8px; border: 1px solid #ddd;">Marca</th>
                    <th style="background: #f8f9fa; padding: 8px; border: 1px solid #ddd; text-align: center;">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands->sortDesc() as $brand => $count)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $brand }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabla de Motocicletas -->
    <table class="table">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Placa</th>
                <th>Propietario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($motorcycles as $motorcycle)
                <tr>
                    <td style="font-weight: bold;">{{ $motorcycle->brand }}</td>
                    <td>{{ $motorcycle->model }}</td>
                    <td>{{ $motorcycle->year }}</td>
                    <td>
                        <span class="badge badge-dark">{{ $motorcycle->licensePlate }}</span>
                    </td>
                    <td>
                        @if($motorcycle->user)
                            {{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($motorcycle->status == 1)
                            <span class="badge badge-success">Activa</span>
                        @else
                            <span class="badge badge-secondary">Inactiva</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($motorcycles->count() == 0)
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p>No hay motocicletas registradas</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>