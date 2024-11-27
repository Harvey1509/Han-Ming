<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use App\Models\RolPermiso;
use Illuminate\Http\Request;

class RolPermisoController extends Controller
{
    // Funciones que devuelven vistas
    public function index()
    {
        $rolesPermisos = RolPermiso::with(['rol', 'permiso'])->get();
        return view('dashboard.role_permissions.index', compact('rolesPermisos'));
    }

    public function create()
    {
        $roles = Rol::pluck('nombre_rol', 'id')->toArray();
        $permisos = Permiso::pluck('nombre_permiso', 'id')->toArray();
        return view('dashboard.role_permissions.create', compact('roles', 'permisos'));
    }

    public function edit($id)
    {
        $rolPermiso = RolPermiso::findOrFail($id);
        $roles = Rol::pluck('nombre_rol', 'id')->toArray();
        $permisos = Permiso::pluck('nombre_permiso', 'id')->toArray();
        return view('dashboard.role_permissions.edit', compact('rolPermiso', 'roles', 'permisos'));
    }

    // Funciones que interactúan con la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_rol' => 'required|exists:roles,id',
            'id_permiso' => 'required|exists:permisos,id',
        ]);

        RolPermiso::create($validatedData);

        return redirect()->route('role_permissions.index')->with('success', 'Relación rol-permiso creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_rol' => 'required|exists:roles,id',
            'id_permiso' => 'required|exists:permisos,id',
        ]);

        $rolPermiso = RolPermiso::findOrFail($id);
        $rolPermiso->update($validatedData);

        return redirect()->route('role_permissions.index')->with('success', 'Relación rol-permiso actualizada correctamente.');
    }

    public function destroy($id)
    {
        $rolPermiso = RolPermiso::findOrFail($id);
        $rolPermiso->delete();

        return redirect()->route('role_permissions.index')->with('success', 'Relación rol-permiso eliminada correctamente.');
    }
}
