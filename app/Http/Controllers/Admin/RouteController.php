<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::latest()->paginate(10);
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.routes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:100',
            'destino' => 'required|string|max:100',
            'fecha_salida' => 'required|date|after_or_equal:today',
            'hora_salida' => 'required|date_format:H:i',
            'duracion' => 'required|numeric|min:0.5',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:500',
            'estado' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            // Combinar fecha y hora de salida
            $fecha_salida = Carbon::parse($validated['fecha_salida'] . ' ' . $validated['hora_salida']);

            // Convertir duración a float y calcular fecha de llegada
            $duracion = (float) $validated['duracion'];
            $fecha_llegada = $fecha_salida->copy()->addHours($duracion);

            // Los asientos disponibles inicialmente son iguales a la capacidad
            $capacidad = (int) $validated['capacidad'];

            Route::create([
                'origen' => $validated['origen'],
                'destino' => $validated['destino'],
                'fecha_salida' => $fecha_salida,
                'fecha_llegada' => $fecha_llegada,
                'precio' => (float) $validated['precio'],
                'capacidad' => $capacidad,
                'asientos_disponibles' => $capacidad,
                'duracion' => $duracion,
                'descripcion' => $validated['descripcion'],
                'estado' => $validated['estado'] ?? true,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.rutas.index')
                ->with('success', 'Ruta creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al crear ruta: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la ruta: ' . $e->getMessage()]);
        }
    }

    public function edit(Route $ruta)
    {
        return view('admin.routes.edit', compact('ruta'));
    }

    public function update(Request $request, Route $ruta)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:100',
            'destino' => 'required|string|max:100',
            'fecha_salida' => 'required|date',
            'hora_salida' => 'required|date_format:H:i',
            'duracion' => 'required|numeric|min:0.5',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:500',
            'estado' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            // Combinar fecha y hora de salida
            $fecha_salida = Carbon::parse($validated['fecha_salida'] . ' ' . $validated['hora_salida']);

            // Convertir duración a float y calcular fecha de llegada
            $duracion = (float) $validated['duracion'];
            $fecha_llegada = $fecha_salida->copy()->addHours($duracion);

            $ruta->update([
                'origen' => $validated['origen'],
                'destino' => $validated['destino'],
                'fecha_salida' => $fecha_salida,
                'fecha_llegada' => $fecha_llegada,
                'precio' => (float) $validated['precio'],
                'capacidad' => (int) $validated['capacidad'],
                'duracion' => $duracion,
                'descripcion' => $validated['descripcion'],
                'estado' => $validated['estado'] ?? $ruta->estado,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.rutas.index')
                ->with('success', 'Ruta actualizada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la ruta: ' . $e->getMessage()]);
        }
    }

    public function destroy(Route $ruta)
    {
        try {
            $ruta->delete();
            return redirect()
                ->route('admin.rutas.index')
                ->with('success', 'Ruta eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar la ruta: ' . $e->getMessage()]);
        }
    }
}
