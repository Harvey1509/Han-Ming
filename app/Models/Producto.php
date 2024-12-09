<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['id_subcategoria', 'nombre_producto', 'descripcion_producto', 'precio_producto', 'imagen_url_producto'];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria');
    }

    // Relación inversa para los carritos
    public function carrito_productos()
    {
        return $this->hasMany(CarritoProducto::class, 'id_producto');
    }

    // Relación a través de CarritoProducto para acceder a la orden
    public function ordenes()
    {
        return $this->hasManyThrough(Orden::class, CarritoProducto::class, 'id_producto', 'id_carrito');
    }
}
