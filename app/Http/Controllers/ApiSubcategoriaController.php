<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Filters\SubcategoriaFilter;
use App\Http\Resources\SubcategoriaCollection;
use App\Http\Resources\SubcategoriaResource;

class ApiSubcategoriaController extends Controller
{
    public function index(Request $request)
    {
        $filtros = new SubcategoriaFilter();
        $consultaElementos = $filtros->transform($request);
        $incluirProductos = request()->query('incluirProductos');
        $subcategorias = Subcategoria::where($consultaElementos);
        if ($incluirProductos) {
            $subcategorias->with('productos');
        }

        return new SubcategoriaCollection($subcategorias->paginate()->appends($request->query()));
    }
    public function show(Subcategoria $subcategoria)
    {
        $incluirProductos = request()->query('incluirProductos');
        if ($incluirProductos) {
            $subcategoria->loadMissing('productos');
        }
        return new SubcategoriaResource($subcategoria);
    }
}
