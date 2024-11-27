<?php

namespace App\Filters;

use App\Filters\ApiFilter;
class ProductoFilter extends ApiFilter
{
    protected $parametrosSeguros = [
        'nombre' => ['like'],
        'precio' => ['lt', 'gt', 'lte', 'gte'],
        'subcategoria' => ['eq'],
    ];
    protected $mapeoColumnas = [
        'subcategoria' => 'id_subcategoria',
        'nombre' => 'nombre_producto',
        'precio' => 'precio_producto',
    ];
    // Cave recalcar que el LIKE funciona con %, por lo que se debe de agregar en el valor del filtro
    // Ejemplo: /productos?nombre[like]=%sam% -> esto buscaria todos los productos que contengan la palabra sam en su nombre
    protected $mapeoOperadores = [
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'eq' => '=',
        'like' => 'LIKE',
    ];

}
