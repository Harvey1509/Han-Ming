<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = "ordenes";

    protected $fillable = ['id_usuario', 'id_carrito', 'total', 'estado'];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'id_carrito');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function productos()
    {
        return $this->hasManyThrough(Producto::class, CarritoProducto::class, 'id_carrito', 'id_producto');
    }
}
