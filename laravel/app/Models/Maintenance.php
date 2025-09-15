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
        'serviceDetails',
        'partsUsed',
        'cost',
        'status',
        'notes',
        'maintenanceDate',
    ];

     // Relación con la motocicleta
    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, 'idMotorcycle', 'idMotorcycle');
    }

    // Relación con el mecánico
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
}
