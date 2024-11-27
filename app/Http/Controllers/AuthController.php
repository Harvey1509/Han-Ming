<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:usuarios,email_usuario',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Usuario::create([
            'nombre_usuario' => $validatedData['name'],
            'apellido_usuario' => $validatedData['lastname'],
            'email_usuario' => $validatedData['email'],
            'password_usuario' => Hash::make($validatedData['password']),
            'id_rol' => 2, // Ejemplo: asignar un rol predeterminado para usuarios comunes.
            'estado_usuario' => 'activo',
            'fecha_registro' => now(),
        ]);

        // Autenticar al usuario después del registro
        Auth::login($usuario);

        return redirect()->route('home')->with('success', 'Registro exitoso. Bienvenido!');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email_usuario' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->onlyInput('email');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
