<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Mantenimientos - Taller Izquierdo</title>
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
        .text-right { text-align: right; }
        .text-small { font-size: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Mantenimientos</h1>
        <p class="subtitle">Taller Izquierdo - Generado el {{ $generatedAt }}</p>
    </div>

    <!-- Información del Reporte -->
    <div style="margin-bottom: 20px; font-size: 11px;">
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
                <p style="margin: 5px 0 0 0; font-size: 11px;">
                    Total Mantenimientos: {{ $totalMaintenances }} <br>
                    Costo Total: Bs {{ number_format($totalCost, 2) }} <br>
                    Completados: {{ $byStatus['completed'] ?? 0 }}
                </p>
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
                        <small class="text-small">Placa: {{ $maintenance->motorcycle->licensePlate }}</small>
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
                    <td class="text-right">Bs {{ number_format($maintenance->cost, 2) }}</td>
                    <td>
                        @if($maintenance->status == 'completed')
                            Completado
                        @elseif($maintenance->status == 'in_progress')
                            En Progreso
                        @elseif($maintenance->status == 'pending')
                            Pendiente
                        @else
                            Cancelado
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($maintenances->count() == 0)
        <div style="text-align: center; padding: 40px; font-size: 11px;">
            <p>No hay mantenimientos registrados</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>