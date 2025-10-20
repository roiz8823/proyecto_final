<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';
    protected $primaryKey = 'idReport';

    protected $fillable = [
        'idUser',
        'reportType', // o 'reporttype' dependiendo de tu BD
        'registrationDate',
        'parameters',
        'file_path'
    ];

    protected $casts = [
        'registrationDate' => 'datetime',
        'parameters' => 'array'
    ];

    protected $appends = ['formatted_type'];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // Accesor para el tipo de reporte formateado
    public function getFormattedTypeAttribute()
    {
        $type = $this->reportType ?? $this->reporttype ?? null;
        
        $types = [
            'sales' => 'Reporte de Ventas',
            'clients' => 'Reporte de Clientes',
            'motorcycles' => 'Reporte de Motocicletas',
            'maintenances' => 'Reporte de Mantenimientos',
            'reservations' => 'Reporte de Reservas',
            'inventory' => 'Reporte de Inventario'
        ];

        return $types[$type] ?? $type ?? 'Desconocido';
    }
}