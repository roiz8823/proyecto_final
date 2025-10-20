<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';
    protected $primaryKey = 'idReservation';

    protected $fillable = [
        'idMotorcycle',
        'reservationDate',
        'reservationTime',
        'status',
        'notes'
    ];

    protected $casts = [
        'reservationDate' => 'date',
        'creationDate' => 'datetime',
        'reservationTime' => 'string'
    ];

    // Relación con motocicleta
    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, 'idMotorcycle', 'idMotorcycle');
    }

    // Otra forma más simple: acceder al usuario a través de la motocicleta
    public function getUserAttribute()
    {
        return $this->motorcycle->user ?? null;
    }

    // Accesor para el estado
    public function getStatusTextAttribute()
    {
        return [
            0 => 'Cancelada',
            1 => 'Pendiente',
            2 => 'Confirmada',
            3 => 'Completada'
        ][$this->status] ?? 'Desconocido';
    }

    // Accesor para fecha y hora combinadas
    public function getDateTimeAttribute()
    {
        return $this->reservationDate->format('d/m/Y') . ' ' . $this->reservationTime;
    }

    // Accesor para clase CSS del estado
    public function getStatusClassAttribute()
    {
        return [
            0 => 'danger',    // Cancelada
            1 => 'warning',   // Pendiente
            2 => 'success',   // Confirmada
            3 => 'info'       // Completada
        ][$this->status] ?? 'secondary';
    }

    // Accesor para creationDate formateada
    public function getFormattedCreationDateAttribute()
    {
        return Carbon::parse($this->creationDate)->format('d/m/Y H:i');
    }

    // Accesor para reservationDate formateada
    public function getFormattedReservationDateAttribute()
    {
        return $this->reservationDate->format('d/m/Y');
    }
}