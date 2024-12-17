<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{

    // Funciones que devuelven vistas

    public function index(Request $request)
    {
        $search = $request->query('search', ''); 
        $rowsPerPage = $request->query('rows', 10);

        $subcategorias = Subcategoria::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre_subcategoria', 'LIKE', "%$search%");
            })
            ->paginate($rowsPerPage);

        return view('dashboard.subcategories.index', compact('subcategorias', 'search', 'rowsPerPage'));
    }



    public function create()
    {
        $categorias = Categoria::pluck('nombre_categoria', 'id')->toArray();
        return view('dashboard.subcategories.create', compact('categorias'));
    }

    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::pluck('nombre_categoria', 'id')->toArray();
        $categoria_asociada = $subcategoria->categoria;
        return view('dashboard.subcategories.edit', compact('subcategoria', 'categorias', 'categoria_asociada'));
    }

    // Funciones que interactúan con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_subcategoria' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        Subcategoria::create([
            'nombre_subcategoria' => $validatedData['nombre_subcategoria'],
            'id_categoria' => $validatedData['id_categoria'],
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Subcategoría creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_subcategoria' => 'required|string|max:255',
            'categoria_perteneciente' => 'required|exists:categorias,id',
        ]);

        $subcategoria = Subcategoria::findOrFail($id);

        $subcategoria->update([
            'nombre_subcategoria' => $validatedData['nombre_subcategoria'],
            'id_categoria' => $validatedData['categoria_perteneciente'],
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Subcategoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->delete();

        return redirect()->route('subcategories.index')->with('success', 'Subcategoría eliminada correctamente.');
    }
}
