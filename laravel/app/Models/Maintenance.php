<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Motorcycle;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance';

    protected $primaryKey = 'idMaintenance';

    protected $fillable = [

        'idMaintenance',
        'idMotorcycle',
        'idMechanic',
        'diagnosis',
        'partsUsed',
        'cost',
        'status',
        'maintenanceDate',
    ];

    protected $casts = [
        'maintenanceDate' => 'datetime',
        'cost' => 'decimal:2',
    ];

    // Relación con la motocicleta
    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, 'idMotorcycle', 'idMotorcycle');
    }

    // Relación con el mecánico - CORREGIDA
    public function mechanic()
    {
        return $this->belongsTo(User::class, 'idMechanic', 'idUser');
    }

    // Accesor para el estado
    public function getStatusTextAttribute()
    {
        return [
            0 => 'Pendiente',
            1 => 'En Progreso',
            2 => 'Completado',
            3 => 'Cancelado'
        ][$this->status] ?? 'Desconocido';
    }

    // Accesor para la clase CSS del estado
    public function getStatusClassAttribute()
    {
        return [
            0 => 'warning',    // Pendiente
            1 => 'info',       // En Progreso
            2 => 'success',    // Completado
            3 => 'danger'      // Cancelado
        ][$this->status] ?? 'secondary';
    }

    // Accesor para el costo formateado
    public function getFormattedCostAttribute()
    {
        return 'Bs ' . number_format($this->cost, 2);
    }
}
