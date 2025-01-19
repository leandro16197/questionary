<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y tiene el rol de admin
        if (Auth::check() && Auth::user()->rol === 1) {
            return $next($request);
        }

        // Redirigir o mostrar error si no es admin
        return redirect('/')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}
