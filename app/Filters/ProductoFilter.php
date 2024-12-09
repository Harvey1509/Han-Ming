<?php

namespace App\Filters;

use App\Filters\ApiFilter;

class ProductoFilter extends ApiFilter
{
    protected $parametrosSeguros = [
        'nombre' => ['like'],
        'precio' => ['lt', 'gt', 'lte', 'gte', 'eq'],
        'subcategoria' => ['eq'],
    ];

    protected $mapeoColumnas = [
        'subcategoria' => 'id_subcategoria',
        'nombre' => 'nombre_producto',
        'precio' => 'precio_producto',
    ];

    protected $mapeoOperadores = [
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'eq' => '=',
        'like' => 'LIKE',
    ];


}
