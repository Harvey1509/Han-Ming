<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role->nombre_rol, $roles)) {
            return redirect()->route('shop.home')->with('error', 'No tienes permiso para acceder a esta área.');
        }


        return $next($request);
    }
}
