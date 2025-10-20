<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo Mantenimiento</title>
    <style>
        body { 
            font-family: 'Courier New', monospace; 
            margin: 0;
            padding: 2mm;
            color: #000;
            line-height: 1;
            font-size: 8px;
            width: 76mm;
        }
        .header { 
            text-align: center; 
            margin-bottom: 3px;
            padding-bottom: 2px;
            border-bottom: 1px solid #000;
        }
        .title { 
            font-size: 10px; 
            margin: 0;
            font-weight: bold;
        }
        .subtitle { 
            font-size: 7px; 
            margin: 1px 0;
        }
        .info-line {
            margin: 1px 0;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 3px 0;
        }
        .section-title {
            font-weight: bold;
            margin: 2px 0 1px 0;
            font-size: 8px;
        }
        .concepts-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2px 0;
            font-size: 7px;
        }
        .concepts-table th,
        .concepts-table td {
            padding: 1px;
        }
        .concepts-table th {
            border-bottom: 1px solid #000;
            font-weight: bold;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2px 0;
            font-size: 7px;
        }
        .payment-table td {
            padding: 1px;
        }
        .total-section {
            text-align: center;
            margin: 3px 0;
            padding: 2px;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        .total-amount {
            font-size: 10px;
            font-weight: bold;
            margin: 1px 0;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 5px;
            padding-top: 1px;
            text-align: center;
            font-size: 6px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-small { font-size: 6px; }
        .border-box {
            border: 1px solid #000;
            padding: 1px;
            margin: 1px 0;
            min-height: 8px;
        }
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
    <div class="info-line"><strong>RECIBO:</strong> MT-{{ str_pad($maintenance->idMaintenance, 6, '0', STR_PAD_LEFT) }}</div>
    <div class="info-line"><strong>FECHA:</strong> {{ \Carbon\Carbon::parse($maintenance->maintenanceDate)->format('d/m/Y H:i') }}</div>

    <div class="divider"></div>

    <!-- Información del Cliente -->
    <div class="section-title">CLIENTE</div>
    <div class="info-line">{{ $maintenance->motorcycle->user->firstName ?? 'N/A' }} {{ $maintenance->motorcycle->user->lastName ?? '' }}</div>
    <div class="info-line">Tel: {{ $maintenance->motorcycle->user->phone ?? 'N/A' }}</div>
    <div class="info-line">{{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</div>
    <div class="info-line">Placa: {{ $maintenance->motorcycle->licensePlate }}</div>

    <div class="divider"></div>

    <!-- Tabla de Conceptos -->
    <table class="concepts-table">
        <thead>
            <tr>
                <th style="text-align: left;">CONCEPTO</th>
                <th width="15%">CANT</th>
                <th width="25%">PRECIO</th>
                <th width="25%">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Servicio Mantenimiento</td>
                <td class="text-center">1</td>
                <td class="text-right">Bs {{ number_format($maintenance->cost, 2) }}</td>
                <td class="text-right">Bs {{ number_format($maintenance->cost, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Resumen de Pago -->
    <table class="payment-table">
        <tr>
            <td width="60%"><strong>TOTAL</strong></td>
            <td class="text-right"><strong>Bs {{ number_format($maintenance->cost, 2) }}</strong></td>
        </tr>
        <tr>
            <td><strong>FORMA DE PAGO</strong></td>
            <td class="text-right">EFECTIVO</td>
        </tr>
    </table>

    <!-- Total a Pagar -->
    <div class="total-section">
        <div class="total-amount">Bs {{ number_format($maintenance->cost, 2) }}</div>
        <div class="text-small">TOTAL A PAGAR</div>
    </div>

    <!-- Diagnóstico -->
    <div class="section-title">DIAGNÓSTICO</div>
    <div class="border-box text-small">
        {{ Str::limit($maintenance->diagnosis ?? 'Sin diagnóstico', 80) }}
    </div>

    @if($maintenance->partsUsed)
    <div class="section-title">REPUESTOS</div>
    <div class="border-box text-small">
        {{ Str::limit($maintenance->partsUsed, 60) }}
    </div>
    @endif

    <!-- Firmas -->
    <div class="signature-line">
        FIRMA CLIENTE
    </div>

    <!-- Pie -->
    <div class="divider"></div>
    <div class="text-center text-small">
        <div>Mecánico: {{ $maintenance->mechanic->firstName ?? 'N/A' }}</div>
        <div>{{ $generatedAt }}</div>
        <div>¡Gracias por su preferencia!</div>
    </div>
</body>
</html>