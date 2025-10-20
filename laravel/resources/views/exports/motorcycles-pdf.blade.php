<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Motocicletas - Taller Izquierdo</title>
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
        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin: 15px 0 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Motocicletas</h1>
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
                    Total Motocicletas: {{ $totalMotorcycles }} <br>
                    Motocicletas Activas: {{ $activeMotorcycles }} <br>
                    Marcas Diferentes: {{ $brands->count() }}
                </p>
            </div>
        </div>
    </div>

    <!-- Distribución por Marcas -->
    <div class="section-title">Distribución por Marcas</div>
    <table class="table">
        <thead>
            <tr>
                <th>Marca</th>
                <th style="text-align: center;">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands->sortDesc() as $brand => $count)
                <tr>
                    <td>{{ $brand }}</td>
                    <td style="text-align: center;">{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla de Motocicletas -->
    <div class="section-title">Lista de Motocicletas</div>
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
                    <td><strong>{{ $motorcycle->brand }}</strong></td>
                    <td>{{ $motorcycle->model }}</td>
                    <td>{{ $motorcycle->year }}</td>
                    <td>{{ $motorcycle->licensePlate }}</td>
                    <td>
                        @if($motorcycle->user)
                            {{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($motorcycle->status == 1)
                            Activa
                        @else
                            Inactiva
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($motorcycles->count() == 0)
        <div style="text-align: center; padding: 40px; font-size: 11px;">
            <p>No hay motocicletas registradas</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>