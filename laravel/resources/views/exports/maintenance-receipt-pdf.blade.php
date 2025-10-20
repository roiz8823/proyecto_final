<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo Mantenimiento</title>
    <style>
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            margin: 5px;
            padding: 0;
            color: #000;
            line-height: 1;
            font-size: 9px;
            width: 80mm;
        }
        .header { 
            text-align: center; 
            margin-bottom: 5px;
            padding-bottom: 3px;
            border-bottom: 1px solid #000;
        }
        .title { 
            font-size: 11px; 
            margin: 0;
            font-weight: bold;
        }
        .subtitle { 
            font-size: 8px; 
            margin: 1px 0;
        }
        .info-line {
            margin: 2px 0;
        }
        .divider {
            border-top: 1px solid #000;
            margin: 4px 0;
        }
        .section-title {
            font-weight: bold;
            margin: 3px 0 1px 0;
            font-size: 9px;
        }
        .concepts-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
            font-size: 8px;
        }
        .concepts-table th,
        .concepts-table td {
            border: 1px solid #000;
            padding: 2px;
        }
        .concepts-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
            font-size: 8px;
        }
        .payment-table td {
            padding: 2px;
            border: 1px solid #000;
        }
        .total-section {
            text-align: center;
            margin: 5px 0;
            padding: 3px;
            border: 1px solid #000;
        }
        .total-amount {
            font-size: 12px;
            font-weight: bold;
            margin: 2px 0;
        }
        .signature-area {
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 35mm;
            text-align: center;
            padding-top: 1px;
            font-size: 7px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-small { font-size: 7px; }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="title">TALLER IZQUIERDO</div>
        <div class="subtitle">Especialistas en Motocicletas</div>
        <div class="subtitle">Tel: 68463106</div>
    </div>

    <!-- Información del Recibo -->
    <div class="receipt-info">
        <div class="info-line"><strong>RECIBO N°:</strong> MT-{{ str_pad($maintenance->idMaintenance, 6, '0', STR_PAD_LEFT) }}</div>
        <div class="info-line"><strong>FECHA:</strong> {{ \Carbon\Carbon::parse($maintenance->maintenanceDate)->format('d/m/Y H:i') }}</div>
    </div>

    <div class="divider"></div>

    <!-- Información del Cliente -->
    <div class="section-title">CLIENTE</div>
    <div class="info-line"><strong>Nombre:</strong> {{ $maintenance->motorcycle->user->firstName ?? 'N/A' }} {{ $maintenance->motorcycle->user->lastName ?? '' }}</div>
    <div class="info-line"><strong>Teléfono:</strong> {{ $maintenance->motorcycle->user->phone ?? 'N/A' }}</div>
    <div class="info-line"><strong>Motocicleta:</strong> {{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</div>
    <div class="info-line"><strong>Placa:</strong> {{ $maintenance->motorcycle->licensePlate }}</div>

    <div class="divider"></div>

    <!-- Tabla de Conceptos -->
    <table class="concepts-table">
        <thead>
            <tr>
                <th>CONCEPTO</th>
                <th width="15%">CANT</th>
                <th width="25%">PRECIO</th>
                <th width="25%">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Servicio Mantenimiento</td>
                <td class="text-center">1</td>
                <td class="text-right">Bs {{ number_format($maintenance->cost , 2) }}</td>
                <td class="text-right">Bs {{ number_format($maintenance->cost , 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Resumen de Pago -->
    <table class="payment-table">
        <tr>
            <td width="60%"><strong>TOTAL</strong></td>
            <td class="text-right">Bs {{ number_format($maintenance->cost, 2) }}</td>
        </tr>
        <tr>
            <td><strong>FORMA DE PAGO</strong></td>
            <td class="text-right">EFECTIVO</td>
        </tr>
    </table>

    <!-- Total a Pagar -->
    <div class="total-section">
        <div class="section-title">TOTAL A PAGAR</div>
        <div class="total-amount">Bs {{ number_format($maintenance->cost, 2) }}</div>
    </div>

    <!-- Diagnóstico -->
    <div class="section-title">DIAGNÓSTICO</div>
    <div class="info-line text-small" style="min-height: 15px; border: 1px solid #ddd; padding: 2px; margin-bottom: 3px;">
        {{ Str::limit($maintenance->diagnosis ?? 'Sin diagnóstico', 80) }}
    </div>

    @if($maintenance->partsUsed)
    <div class="section-title">REPUESTOS</div>
    <div class="info-line text-small" style="min-height: 12px; border: 1px solid #ddd; padding: 2px;">
        {{ Str::limit($maintenance->partsUsed, 60) }}
    </div>
    @endif

   <!-- Firmas -->
    <div class="divider"></div>
    <div class="text-center text-small">
        <div>FIRMA CLIENTE</div>
    </div>

    <!-- Pie -->
    <div class="divider"></div>
    <div class="text-center text-small">
        <div>Mecánico: {{ $maintenance->mechanic->firstName ?? 'N/A' }}</div>
        <div>Recibo generado: {{ $generatedAt }}</div>
        <div>¡Gracias por su preferencia!</div>
    </div>
</body>
</html>