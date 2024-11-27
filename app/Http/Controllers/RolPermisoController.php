<?php

namespace App\Http\Controllers;

use App\Models\RolPermiso;
use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;

class RolPermisoController extends Controller
{
    // Funciones que devuelven vistas

    public function index()
    {
        $roles_permisos = RolPermiso::with(['rol', 'permiso'])->get();
        return view('dashboard.role_permissions.index', compact('roles_permisos'));
    }

    public function create()
    {
        $roles = Rol::pluck('nombre_rol', 'id')->toArray();
        $permisos = Permiso::pluck('nombre_permiso', 'id')->toArray();
        return view('dashboard.role_permissions.create', compact('roles', 'permisos'));
    }

    public function edit($id_rol, $id_permiso)
    {
        $rol_permiso = RolPermiso::where('id_rol', $id_rol)
                                ->where('id_permiso', $id_permiso)
                                ->firstOrFail();

        $roles = Rol::pluck('nombre_rol', 'id')->toArray();
        $permisos = Permiso::pluck('nombre_permiso', 'id')->toArray();

        return view('dashboard.role_permissions.edit', compact('rol_permiso', 'roles', 'permisos'));
    }

    // Funciones que interactúan con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_rol' => 'required|exists:roles,id',
            'id_permiso' => 'required|exists:permisos,id',
        ]);

        RolPermiso::create($validatedData);

        return redirect()->route('role_permissions.index')->with('success', 'Relación Rol-Permiso creada correctamente.');
    }

    public function update(Request $request, $id_rol, $id_permiso)
    {
        $validatedData = $request->validate([
            'id_rol' => 'required|exists:roles,id',
            'id_permiso' => 'required|exists:permisos,id',
        ]);

        $rol_permiso = RolPermiso::where('id_rol', $id_rol)
                                ->where('id_permiso', $id_permiso)
                                ->firstOrFail();

        $rol_permiso->update($validatedData);

        return redirect()->route('role_permissions.index')->with('success', 'Relación Rol-Permiso actualizada correctamente.');
    }

    public function destroy($id_rol, $id_permiso)
    {
        $rol_permiso = RolPermiso::where('id_rol', $id_rol)
                                ->where('id_permiso', $id_permiso)
                                ->firstOrFail();

        $rol_permiso->delete();

        return redirect()->route('role_permissions.index')->with('success', 'Relación Rol-Permiso eliminada correctamente.');
    }
    }
