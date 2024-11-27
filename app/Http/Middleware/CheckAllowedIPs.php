<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAllowedIPs
{

    protected $allowedIPs = [
        '127.0.0.1', // Para desarrollar en localhost
    ];

    /**
     * Manejar una solicitud entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->ip(), $this->allowedIPs)) {
            return redirect()->route('shop.home')->with('error', 'No tienes acceso desde esta IP.');
        }

        return $next($request);
    }
}
