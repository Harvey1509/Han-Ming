<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'estado'];

    public function productos()
    {
        return $this->hasMany(CarritoProducto::class, 'id_carrito');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function orden()
    {
        return $this->hasOne(Orden::class, 'id_carrito');
    }
}
