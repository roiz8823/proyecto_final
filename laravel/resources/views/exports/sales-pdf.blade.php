<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas - Taller Izquierdo</title>
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
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Ventas</h1>
        <p class="subtitle">Taller Izquierdo - Generado el {{ $generatedAt }}</p>
    </div>

    <!-- Información del Reporte -->
    <div style="margin-bottom: 20px; font-size: 11px;">
        <p><strong>Generado por:</strong> {{ $generatedBy }}</p>
        <p><strong>Período:</strong> 
            @if($startDate && $endDate)
                {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            @else
                Todo el período
            @endif
        </p>
    </div>

    <!-- Estadísticas -->
    <div class="stats">
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div class="stat-box" style="flex: 1;">
                <p style="margin: 5px 0 0 0; font-size: 11px;">
                    Total Ventas: {{ $totalSales }} <br>
                    Ingreso Total: Bs {{ number_format($totalRevenue, 2) }} <br>
                    Promedio por Venta: Bs {{ number_format($averageSale, 2) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Tabla de Ventas -->
    <table class="table">
        <thead>
            <tr>
                <th># Venta</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Productos</th>
                <th class="text-right">Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>#{{ $sale->idSale }}</td>
                    <td>
                        @if($sale->user)
                            {{ $sale->user->firstName }} {{ $sale->user->lastName }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $sale->saleDate->format('d/m/Y H:i') }}</td>
                    <td class="text-center">{{ $sale->details->count() }}</td>
                    <td class="text-right">Bs {{ number_format($sale->total, 2) }}</td>
                    <td>
                        @if($sale->status == 1)
                            Activa
                        @else
                            Inactiva
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($sales->count() == 0)
        <div style="text-align: center; padding: 40px; font-size: 11px;">
            <p>No hay ventas en el período seleccionado</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>