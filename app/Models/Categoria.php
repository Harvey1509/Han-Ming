<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_categoria'];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class, 'id_categoria');
    }
}

