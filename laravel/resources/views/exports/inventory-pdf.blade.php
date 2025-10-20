<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario - Taller Izquierdo</title>
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
        <h1 class="title">Reporte de Inventario</h1>
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
                <p style="margin: 5px 0 0 0; font-size: 11px;">
                    Total Productos: {{ $totalProducts }} <br>
                    Valor Total: Bs {{ number_format($totalValue, 2) }} <br>
                    Stock Bajo: {{ $lowStock }} <br>
                    Sin Stock: {{ $outOfStock }}
                </p>
            </div>
        </div>
    </div>

    <!-- Productos con Stock Bajo -->
    @if($lowStock > 0)
    <div style="margin: 20px 0; border: 1px solid #000; padding: 10px;">
        <h3 style="font-size: 12px; margin-top: 0;">Productos con Stock Bajo</h3>
        <table style="width: 100%; border-collapse: collapse; font-size: 11px;">
            <thead>
                <tr>
                    <th style="padding: 8px; border: 1px solid #000; background-color: #f0f0f0;">Producto</th>
                    <th style="padding: 8px; border: 1px solid #000; background-color: #f0f0f0; text-align: center;">Stock Actual</th>
                    <th style="padding: 8px; border: 1px solid #000; background-color: #f0f0f0; text-align: right;">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products->where('stock', '<', 10)->where('stock', '>', 0) as $product)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #000;">
                            <strong>{{ $product->name }}</strong>
                            <br>
                            <small>{{ $product->category }}</small>
                        </td>
                        <td style="padding: 8px; border: 1px solid #000; text-align: center;">
                            {{ $product->stock }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #000; text-align: right;">
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
                    <td>{{ $product->category }}</td>
                    <td class="text-center">{{ $product->stock }}</td>
                    <td class="text-right">Bs {{ number_format($product->price, 2) }}</td>
                    <td class="text-right">Bs {{ number_format($product->stock * $product->price, 2) }}</td>
                    <td>
                        @if($product->stock == 0)
                            Sin Stock
                        @elseif($product->stock < 10)
                            Stock Bajo
                        @else
                            Disponible
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($products->count() == 0)
        <div style="text-align: center; padding: 40px; font-size: 11px;">
            <p>No hay productos en el inventario</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>