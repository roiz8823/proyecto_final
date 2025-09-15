<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';

    protected $primaryKey = 'idSale';

    protected $fillable = [
       
        'idSale',
        'idUser',
        'idMechanic',
        'saleDate',
        'total',
        'status',
    ];
}
