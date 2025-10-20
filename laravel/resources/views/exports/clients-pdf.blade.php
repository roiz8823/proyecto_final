<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Clientes - Taller Izquierdo</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
            color: #000;
            background-color: #fff;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
            border-bottom: 1px solid #000; 
            padding-bottom: 10px; 
        }
        .title { 
            font-size: 14px; 
            margin-bottom: 5px; 
        }
        .subtitle { 
            font-size: 12px; 
        }
        .stats { 
            margin: 20px 0; 
        }
        .stat-box { 
            border: 1px solid #000; 
            padding: 10px; 
            margin: 10px 0; 
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
            font-size: 11px;
        }
        .table th, .table td { 
            padding: 8px; 
            border: 1px solid #000; 
            text-align: left;
        }
        .table th { 
            background-color: #f0f0f0; 
        }
        .footer { 
            margin-top: 30px; 
            text-align: center; 
            font-size: 11px; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Clientes</h1>
        <p class="subtitle">Taller Izquierdo - Generado el {{ $generatedAt }}</p>
    </div>

    <!-- Información del Reporte -->
    <div style="margin-bottom: 20px; font-size: 11px;">
        <p><strong>Generado por:</strong> {{ $generatedBy }}</p>
    </div>

    <!-- Estadísticas -->
    <div class="stats">
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div class="stat-box" style="flex: 1;">
                <p style="margin: 5px 0 0 0; font-size: 11px;">Total clientes: {{ $totalClients }} <br>
                    Clientes Activos: {{ $activeClients }} <br>
                    Con Motocicletas: {{ $clientsWithMotorcycles }}</p>
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
                    <td style="text-align: center;">{{ $client->motorcycles_count }}</td>
                    <td>
                        @if($client->status == 1)
                            Activo
                        @else
                            Inactivo
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
        <div style="text-align: center; padding: 40px; font-size: 11px;">
            <p>No hay clientes registrados</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>