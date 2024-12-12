<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Log::channel('daily')->info('Middleware de autenticación', [
            'path' => $request->path(),
            'authenticated' => Auth::check(),
            'user' => Auth::check() ? Auth::user()->email : 'No autenticado'
        ]);

        if (!Auth::check()) {
            Log::channel('daily')->warning('Acceso no autorizado', [
                'path' => $request->path()
            ]);

            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión');
        }

        return $next($request);
    }
}
