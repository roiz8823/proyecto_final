<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
        'recommendations',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser'); // Tercer parámetro: PK de users
    }
}
