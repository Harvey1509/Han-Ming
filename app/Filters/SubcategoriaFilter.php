<?php

namespace App\Filters;

use App\Filters\ApiFilter;
class SubcategoriaFilter extends ApiFilter
{
    protected $parametrosSeguros = [
        'nombre' => ['like'],
        'categoria' => ['eq'], 
    ];
    protected $mapeoColumnas = [
        'categoria' => 'id_categoria',
        'nombre' => 'nombre_subcategoria',
    ];
    // Cave recalcar que el LIKE funciona con %, por lo que se debe de agregar en el valor del filtro
    // Ejemplo: /subcategorias?nombre[like]=%sam% -> esto buscaria todos los productos que contengan la palabra sam en su nombre
    protected $mapeoOperadores = [
        'eq' => '=',
        'like' => 'LIKE',
    ];

}
