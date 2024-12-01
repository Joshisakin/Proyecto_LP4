<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Schedule;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Auth::user()->reservations()
            ->with(['route', 'schedule'])
            ->orderBy('travel_date', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create(Route $route)
    {
        $schedules = $route->schedules;
        return view('reservations.create', compact('route', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'schedule_id' => 'required|exists:schedules,id',
            'travel_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'passenger_count' => 'required|integer|min:1|max:10',
        ], [
            'travel_date.after_or_equal' => 'La fecha de viaje debe ser hoy o una fecha futura.',
            'passenger_count.max' => 'No se pueden reservar más de 10 asientos por reserva.',
            'passenger_count.min' => 'Debe reservar al menos 1 asiento.',
        ]);

        // Verificar que el horario pertenece a la ruta
        $schedule = Schedule::findOrFail($request->schedule_id);
        if ($schedule->route_id != $request->route_id) {
            return back()->withErrors(['schedule_id' => 'El horario seleccionado no corresponde a esta ruta.']);
        }

        // Crear la reserva
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'route_id' => $request->route_id,
            'schedule_id' => $request->schedule_id,
            'travel_date' => $request->travel_date,
            'passenger_count' => $request->passenger_count,
            'status' => 'confirmed',
            'total_price' => Route::find($request->route_id)->price * $request->passenger_count,
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', '¡Reserva creada exitosamente! Te esperamos el ' . 
                Carbon::parse($reservation->travel_date)->isoFormat('dddd D [de] MMMM') . 
                ' para tu viaje.');
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.show', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        
        // Solo permitir cancelar reservas futuras
        if (Carbon::parse($reservation->travel_date)->isPast()) {
            return back()->withErrors(['error' => 'No se pueden cancelar reservas de fechas pasadas.']);
        }

        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('reservations.index')
            ->with('success', 'Reserva cancelada exitosamente.');
    }
}
