<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $primaryKey = 'idDetail';

    protected $fillable = [
        'idSale',
        'idPart',
        'quantity',
        'unitPrice',
        'totalPrice'
    ];

    protected $casts = [
        'unitPrice' => 'decimal:2',
        'totalPrice' => 'decimal:2'
    ];

    // Relación con Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'idSale');
    }

    // Relación con Store (Part)
    public function part()
    {
        return $this->belongsTo(Store::class, 'idPart');
    }
}