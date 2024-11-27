<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenPublicitaria extends Model
{
    use HasFactory;

    protected $table = 'imagenes_publicitarias';
    protected $fillable = ['url_imagen', 'fecha_inicio', 'fecha_fin', 'estado', 'tipo', 'orden'];
}
