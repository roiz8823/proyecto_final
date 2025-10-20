<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas - Taller Izquierdo</title>
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
    <div style="margin-bottom: 20px;">
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
                <h3 style="margin: 0; color: #2c3e50;">{{ $totalSales }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Total Ventas</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #27ae60;">Bs {{ number_format($totalRevenue, 2) }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Ingreso Total</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #2980b9;">Bs {{ number_format($averageSale, 2) }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Promedio por Venta</p>
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
                    <td class="text-center">{{ $sale->details->count() }} productos</td>
                    <td class="text-right">Bs {{ number_format($sale->total, 2) }}</td>
                    <td>
                        @if($sale->status == 1)
                            <span class="badge badge-success">Activa</span>
                        @else
                            <span class="badge badge-secondary">Inactiva</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($sales->count() == 0)
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p>No hay ventas en el período seleccionado</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>