<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Funciones que devuelven vistas

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $rowsPerPage = $request->query('rows', 10);

        $roles = Rol::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre_rol', 'LIKE', "%$search%");
            })
            ->paginate($rowsPerPage);

        return view('dashboard.roles.index', compact('roles', 'search', 'rowsPerPage'));
    }


    public function create()
    {
        return view('dashboard.roles.create');
    }

    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        return view('dashboard.roles.edit', compact('rol'));
    }

    // Funciones que interactúan con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_rol' => 'required|string|max:255|unique:roles,nombre_rol',
        ]);

        Rol::create([
            'nombre_rol' => $validatedData['nombre_rol'],
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_rol' => 'required|string|max:255|unique:roles,nombre_rol,' . $id,
        ]);

        $rol = Rol::findOrFail($id);
        $rol->update([
            'nombre_rol' => $validatedData['nombre_rol'],
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
