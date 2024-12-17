<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    use HasFactory;

    protected $fillable = ['id_carrito', 'id_producto', 'cantidad', 'precio_unitario'];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'id_carrito');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function carrito_productos()
    {
        return $this->hasMany(CarritoProducto::class, 'id_producto');
    }
}
