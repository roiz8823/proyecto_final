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
        'idUser',
        'saleDate',
        'total',
        'status'
    ];

    protected $casts = [
        'saleDate' => 'datetime',
        'total' => 'decimal:2'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // Relación con Details
    public function details()
    {
        return $this->hasMany(Detail::class, 'idSale');
    }

    // Scope para ventas activas
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Calcular total de la venta sumando los detalles
    public function calculateTotal()
    {
        return $this->details->sum('totalPrice');
    }
}