<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    // Funciones que devuelven vistas

    public function index()
    {
        $permisos = Permiso::all();
        return view('dashboard.permissions.index', compact('permisos'));
    }

    public function create()
    {
        return view('dashboard.permissions.create');
    }

    public function edit($id)
    {
        $permiso = Permiso::findOrFail($id);
        return view('dashboard.permissions.edit', compact('permiso'));
    }

    // Funciones que interactúan con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_permiso' => 'required|string|max:255|unique:permisos,nombre_permiso',
        ]);

        Permiso::create($validatedData);

        return redirect()->route('permissions.index')->with('success', 'Permiso creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_permiso' => 'required|string|max:255|unique:permisos,nombre_permiso,' . $id,
        ]);

        $permiso = Permiso::findOrFail($id);
        $permiso->update($validatedData);

        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy($id)
    {
        $permiso = Permiso::findOrFail($id);
        $permiso->delete();

        return redirect()->route('permissions.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
