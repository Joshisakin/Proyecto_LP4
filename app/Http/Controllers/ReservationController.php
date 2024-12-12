<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $reservations = Reservation::with(['route'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        $ruta = Route::findOrFail($request->ruta_id);
        return view('reservations.create', compact('ruta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruta_id' => 'required|exists:rutas,id',
            'cantidad_pasajeros' => 'required|integer|min:1|max:10',
            'comentarios' => 'nullable|string|max:500',
        ]);

        $ruta = Route::findOrFail($request->ruta_id);

        // Verificar disponibilidad
        if ($ruta->capacidad < $request->cantidad_pasajeros) {
            return back()->withErrors(['cantidad_pasajeros' => 'No hay suficientes asientos disponibles.']);
        }

        // Crear la reservación
        $reservation = new Reservation();
        $reservation->user_id = auth()->id();
        $reservation->route_id = $ruta->id;
        $reservation->estado = 'pendiente';
        $reservation->num_pasajeros = $request->cantidad_pasajeros;
        $reservation->total = $ruta->precio * $request->cantidad_pasajeros;
        $reservation->notas = $request->comentarios;
        $reservation->save();

        // Actualizar capacidad de la ruta
        $ruta->capacidad -= $request->cantidad_pasajeros;
        $ruta->save();

        return redirect()->route('reservations.show', $reservation)
            ->with('success', '¡Reserva creada exitosamente! Por favor, complete el pago para confirmarla.');
    }

    public function show(Reservation $reservation)
    {
        // Verificar si el usuario actual es el dueño de la reserva
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }

        return view('reservations.show', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        // Verificar que el usuario actual es el dueño de la reserva
        $this->authorize('delete', $reservation);

        try {
            // Restaurar los asientos disponibles en la ruta
            $reservation->route->increment('capacidad', $reservation->num_pasajeros);

            // Eliminar la reserva
            $reservation->delete();

            return redirect()->route('reservations.index')
                ->with('success', 'Reserva eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar la reserva: ' . $e->getMessage()]);
        }
    }
}
