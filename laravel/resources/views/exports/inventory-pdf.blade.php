<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario - Taller Izquierdo</title>
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
        .badge-danger { background: #dc3545; color: white; }
        .badge-info { background: #17a2b8; color: white; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Inventario</h1>
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
                <h3 style="margin: 0; color: #2c3e50;">{{ $totalProducts }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Total Productos</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #28a745;">Bs {{ number_format($totalValue, 2) }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Valor Total</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #ffc107;">{{ $lowStock }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Stock Bajo</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #dc3545;">{{ $outOfStock }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Sin Stock</p>
            </div>
        </div>
    </div>

    <!-- Productos con Stock Bajo -->
    @if($lowStock > 0)
    <div style="margin: 20px 0; border: 2px solid #ffc107; border-radius: 5px; padding: 15px;">
        <h3 style="color: #856404; margin-top: 0;">⚠️ Productos con Stock Bajo</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="background: #fff3cd; padding: 8px; border: 1px solid #ffeaa7;">Producto</th>
                    <th style="background: #fff3cd; padding: 8px; border: 1px solid #ffeaa7; text-align: center;">Stock Actual</th>
                    <th style="background: #fff3cd; padding: 8px; border: 1px solid #ffeaa7; text-align: right;">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products->where('stock', '<', 10)->where('stock', '>', 0) as $product)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ffeaa7;">
                            <strong>{{ $product->name }}</strong>
                            <br>
                            <small>{{ $product->category }}</small>
                        </td>
                        <td style="padding: 8px; border: 1px solid #ffeaa7; text-align: center;">
                            <span class="badge badge-warning">{{ $product->stock }}</span>
                        </td>
                        <td style="padding: 8px; border: 1px solid #ffeaa7; text-align: right;">
                            Bs {{ number_format($product->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Tabla de Inventario Completo -->
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio Unitario</th>
                <th>Valor Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        <br>
                        <small>{{ Str::limit($product->description, 30) }}</small>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $product->category }}</span>
                    </td>
                    <td class="text-center">
                        @if($product->stock == 0)
                            <span class="badge badge-danger">{{ $product->stock }}</span>
                        @elseif($product->stock < 10)
                            <span class="badge badge-warning">{{ $product->stock }}</span>
                        @else
                            <span class="badge badge-success">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td class="text-right">${{ number_format($product->price, 2) }}</td>
                    <td class="text-right">${{ number_format($product->stock * $product->price, 2) }}</td>
                    <td>
                        @if($product->stock == 0)
                            <span class="badge badge-danger">Sin Stock</span>
                        @elseif($product->stock < 10)
                            <span class="badge badge-warning">Stock Bajo</span>
                        @else
                            <span class="badge badge-success">Disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($products->count() == 0)
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p>No hay productos en el inventario</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>