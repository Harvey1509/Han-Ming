<?php

namespace App\Filters;

use App\Filters\ApiFilter;

class CategoriaFilter extends ApiFilter
{
    protected $parametrosSeguros = [
        'nombre' => ['like'],
    ];
    protected $mapeoColumnas = [
        'nombre' => 'nombre_categoria',
    ];
    // Cave recalcar que el LIKE funciona con %, por lo que se debe de agregar en el valor del filtro
    // Ejemplo: /categorias?nombre[like]=%sam% -> esto buscaria todos los productos que contengan la palabra sam en su nombre
    protected $mapeoOperadores = [
        'like' => 'LIKE',
    ];
}
