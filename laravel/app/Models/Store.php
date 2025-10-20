<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';
    protected $primaryKey = 'idPart';

    protected $fillable = [
        'name',
        'category',
        'stock',
        'price',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'status' => 'boolean',
        'registrationDate' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Accesor para el estado
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Activo' : 'Inactivo';
    }

    // Accesor para alerta de stock bajo
    public function getLowStockAttribute()
    {
        return $this->stock < 10; // Considerar stock bajo menos de 10 unidades
    }

    // Accesor para el precio formateado
    public function getFormattedPriceAttribute()
    {
        return 'Bs ' . number_format($this->price, 2);
    }

    // Scope para repuestos activos
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope para repuestos con stock bajo
    public function scopeLowStock($query)
    {
        return $query->where('stock', '<', 10);
    }

    // Scope por categoría
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}