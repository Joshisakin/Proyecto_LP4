<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Route::available()
            ->orderBy('fecha_salida')
            ->paginate(10);
        return view('rutas.index', compact('rutas'));
    }

    public function show(Route $route)
    {
        if (!$route->estado || $route->fecha_salida < now() || $route->asientos_disponibles <= 0) {
            abort(404, 'Ruta no disponible');
        }
        return view('rutas.show', compact('route'));
    }

    public function search(Request $request)
    {
        $query = Route::query();

        if ($request->filled('origen')) {
            $query->where('origen', 'like', '%' . $request->origen . '%');
        }

        if ($request->filled('destino')) {
            $query->where('destino', 'like', '%' . $request->destino . '%');
        }

        $rutas = $query->orderBy('fecha_salida')->paginate(10);

        return view('rutas.index', compact('rutas'));
    }
}
