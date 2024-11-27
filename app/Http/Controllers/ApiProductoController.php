<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Filters\ProductoFilter;
use App\Http\Resources\ProductoCollection;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;

class ApiProductoController extends Controller
{
    public function index(Request $request)
    {
        $filtros = new ProductoFilter();
        $consultaElementos = $filtros->transform($request);
        $productos = Producto::where($consultaElementos);
        return new ProductoCollection($productos->paginate()->appends($request->query()));
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto);
    }
}
