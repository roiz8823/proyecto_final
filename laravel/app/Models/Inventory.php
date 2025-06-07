<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;


    protected $table = 'inventory';

    protected $fillable = [
       
        'idPart',
        'name',
        'description',
        'category',
        'stock',
        'price',
        'status',
        'registrationDate',
    ];
}
