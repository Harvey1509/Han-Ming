<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [ 'id', 'nombre_producto', 'id_subcategoria', 'precio_producto', 'descripcion_producto', 'imagen_url_producto'];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria');
    }

    public function carrito_productos()
    {
        return $this->hasMany(CarritoProducto::class, 'id_producto');
    }

    public function ordenes()
    {
        return $this->hasManyThrough(Orden::class, CarritoProducto::class, 'id_producto', 'id_carrito');
    }
}
