<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Funciones que devuelven vistas

    public function index(Request $request)
    {
        $search = $request->query('search', ''); 
        $rowsPerPage = $request->query('rows', 10);

        $usuarios = Usuario::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre_usuario', 'LIKE', "%$search%");})
            ->paginate($rowsPerPage);

        return view('dashboard.users.index', compact('usuarios', 'search', 'rowsPerPage'));
    }


    public function create()
    {
        $roles = Rol::pluck('nombre_rol', 'id')->toArray();
        return view('dashboard.users.create', compact('roles'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::pluck('nombre_rol', 'id')->toArray();
        return view('dashboard.users.edit', compact('usuario', 'roles'));
    }

    // Funciones que interactúan con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_usuario' => 'required|string|max:50',
            'apellido_usuario' => 'required|string|max:50',
            'email_usuario' => 'required|email|unique:usuarios,email_usuario',
            'password_usuario' => 'required|string|min:8',
            'id_rol' => 'required|exists:roles,id',
        ]);

        Usuario::create([
            'nombre_usuario' => $validatedData['nombre_usuario'],
            'apellido_usuario' => $validatedData['apellido_usuario'],
            'email_usuario' => $validatedData['email_usuario'],
            'password_usuario' => bcrypt($validatedData['password_usuario']),
            'id_rol' => $validatedData['id_rol'],
            'fecha_registro' => now(),
            'estado_usuario' => 'activo',
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_usuario' => 'required|string|max:50',
            'apellido_usuario' => 'required|string|max:50',
            'email_usuario' => 'required|email|unique:usuarios,email_usuario,' . $id,
            'password_usuario' => 'nullable|string|min:8',
            'id_rol' => 'required|exists:roles,id',
        ]);

        $usuario = Usuario::findOrFail($id);

        $usuario->update([
            'nombre_usuario' => $validatedData['nombre_usuario'],
            'apellido_usuario' => $validatedData['apellido_usuario'],
            'email_usuario' => $validatedData['email_usuario'],
            'password_usuario' => $validatedData['password_usuario'] 
                ? bcrypt($validatedData['password_usuario']) 
                : $usuario->password_usuario,
            'id_rol' => $validatedData['id_rol'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
