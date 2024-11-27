<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Filters\CategoriaFilter;
use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;

class ApiCategoriaController extends Controller
{

    public function index(Request $request)
    {
        $filtros = new CategoriaFilter();
        $consultaElementos = $filtros->transform($request);
        $incluirSubcategorias = $request->query('incluirSubcategorias');
        $categorias = Categoria::where($consultaElementos);
        if ($incluirSubcategorias) {
            $categorias = $categorias->whereHas('subcategorias', function ($query) {
                $query->whereHas('productos');
            })->with(['subcategorias' => function ($query) {
                $query->whereHas('productos');
            }]);
        }
        return new CategoriaCollection($categorias->get());
    }


    public function show(Categoria $categoria)
    {
        $incluirCategorias = request()->query('incluirCategorias');
        if ($incluirCategorias) {
            $categoria->loadMissing('categorias');
        }
        return new CategoriaResource($categoria);
    }
}
