<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $parametrosSeguros = [];
    protected $mapeoColumnas = [];
    protected $mapeoOperadores = [];

    public function transform(Request $solicitud)
    {
        $filtros = [];
        foreach ($this->parametrosSeguros as $parametro => $operadores) {
            $consulta = $solicitud->query($parametro);
            if (!isset($consulta)) {
                continue;
            }
            $columna = $this->mapeoColumnas[$parametro] ?? $parametro;
            foreach ($operadores as $operador) {
                if (isset($consulta[$operador])) {
                    $filtros[] = [
                        $columna,
                        $this->mapeoOperadores[$operador],
                        $consulta[$operador],
                    ];                    
                }
            }
        }
        return $filtros;
    }
}
