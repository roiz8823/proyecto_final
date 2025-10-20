<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Reservas - Taller Izquierdo</title>
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
        .badge-info { background: #17a2b8; color: white; }
        .badge-secondary { background: #6c757d; color: white; }
        .badge-primary { background: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Reservas</h1>
        <p class="subtitle">Taller Izquierdo - Generado el {{ $generatedAt }}</p>
    </div>

    <!-- Información del Reporte -->
    <div style="margin-bottom: 20px;">
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
                <h3 style="margin: 0; color: #2c3e50;">{{ $totalReservations }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Total Reservas</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #28a745;">{{ $confirmedReservations }}</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Confirmadas</p>
            </div>
            <div class="stat-box" style="flex: 1;">
                <h3 style="margin: 0; color: #17a2b8;">{{ $confirmationRate }}%</h3>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Tasa de Confirmación</p>
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
                        <small>{{ \Carbon\Carbon::parse($reservation->reservationTime)->format('h:i A') }}</small>
                    </td>
                    <td>
                        {{ $reservation->motorcycle->user->firstName ?? 'N/A' }} {{ $reservation->motorcycle->user->lastName ?? '' }}
                        <br>
                        <small>{{ $reservation->motorcycle->user->email ?? 'N/A' }}</small>
                    </td>
                    <td>
                        <strong>{{ $reservation->motorcycle->brand }}</strong> 
                        {{ $reservation->motorcycle->model }}
                        <br>
                        <small>Placa: {{ $reservation->motorcycle->licensePlate }}</small>
                    </td>
                    <td>{{ Str::limit($reservation->notes, 50) }}</td>
                    <td>
                        @if($reservation->status == 'confirmed')
                            <span class="badge badge-success">Confirmada</span>
                        @elseif($reservation->status == 'pending')
                            <span class="badge badge-warning">Pendiente</span>
                        @elseif($reservation->status == 'completed')
                            <span class="badge badge-info">Completada</span>
                        @else
                            <span class="badge badge-secondary">Cancelada</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($reservations->count() == 0)
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p>No hay reservas registradas</p>
        </div>
    @endif

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Taller Izquierdo</p>
    </div>
</body>
</html>