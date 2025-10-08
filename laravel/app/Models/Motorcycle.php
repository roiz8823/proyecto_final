<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reservation;

class Motorcycle extends Model
{
    use HasFactory;

    protected $table = 'motorcycle';

    protected $primaryKey = 'idMotorcycle';

    protected $fillable = [
       
        'idMotorcycle',
        'idUser',
        'brand',
        'model',
        'year',
        'licensePlate',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser'); // Tercer parámetro: PK de users
    }

    // Relación con las reservas de esta motocicleta
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'idMotorcycle', 'idMotorcycle');
    }
    
    // Relación con los mantenimientos de esta motocicleta
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'idMotorcycle', 'idMotorcycle');
    }
}
