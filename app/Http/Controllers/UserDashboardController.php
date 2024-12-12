<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener estadísticas del usuario
        $stats = [
            'active_reservations' => Reservation::where('user_id', $user->id)
                ->where('estado', '!=', 'cancelada')
                ->whereHas('route', function($query) {
                    $query->where('fecha_salida', '>', now());
                })
                ->count(),
            'completed_reservations' => Reservation::where('user_id', $user->id)
                ->where('estado', 'confirmada')
                ->whereHas('route', function($query) {
                    $query->where('fecha_salida', '<', now());
                })
                ->count()
        ];

        // Obtener próximas reservas
        $upcomingReservations = Reservation::with('route')
            ->where('user_id', $user->id)
            ->where('estado', '!=', 'cancelada')
            ->whereHas('route', function($query) {
                $query->where('fecha_salida', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Obtener rutas recomendadas
        $recommendedRoutes = Route::where('estado', true)
            ->where('fecha_salida', '>', now())
            ->where('capacidad', '>', 0)
            ->orderBy('fecha_salida', 'asc')
            ->take(3)
            ->get();

        return view('user.dashboard', compact('stats', 'upcomingReservations', 'recommendedRoutes'));
    }
}
