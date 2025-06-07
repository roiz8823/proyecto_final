<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
