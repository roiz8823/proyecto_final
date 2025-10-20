<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Reservas - Taller Izquierdo</title>
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
        .text-small {
            font-size: 9px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Reservas</h1>
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
                    Total Reservas: {{ $totalReservations }} <br>
                    Confirmadas: {{ $confirmedReservations }} <br>
                    Tasa de Confirmación: {{ $confirmationRate }}%
                </p>
            </div>
        </div>
    </div>

    <!-- Tabla de Reservas -->
    <table class="table">
        <thead>
            <tr>
                <th>Fecha Reserva</th>
                <th>Cliente</th>
                <th>Motocicleta</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>
                        <strong>{{ \Carbon\Carbon::parse($reservation->reservationDate)->format('d/m/Y') }}</strong>
                        <br>
                        <small class="text-small">{{ \Carbon\Carbon::parse($reservation->reservationTime)->format('h:i A') }}</small>
                    </td>
                    <td>
                        {{ $reservation->motorcycle->user->firstName ?? 'N/A' }} {{ $reservation->motorcycle->user->lastName ?? '' }}
                    </td>
                    <td>
                        <strong>{{ $reservation->motorcycle->brand }}</strong> 
                        {{ $reservation->motorcycle->model }}
                        <br>
                        <small class="text-small">Placa: {{ $reservation->motorcycle->licensePlate }}</small>
                    </td>
                    <td>{{ Str::limit($reservation->notes, 50) }}</td>
                    <td>
                        @if($reservation->status == 'confirmed')
                            Confirmada
                        @elseif($reservation->status == 'pending')
                            Pendiente
                        @elseif($reservation->status == 'completed')
                            Completada
                        @else
                            Cancelada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($reservations->count() == 0)
        <div style="text-align: center; padding: 40px; font-size: 11px;">
            <p>No hay reservas registradas</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>