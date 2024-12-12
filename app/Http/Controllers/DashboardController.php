<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Obtener todas las reservas del usuario
        $upcomingReservations = Reservation::with('route')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener estadísticas de reservas
        $stats = [
            'active_reservations' => Reservation::where('user_id', $userId)
                ->whereHas('route', function($query) {
                    $query->where('fecha_salida', '>', now());
                })
                ->count(),
            'completed_reservations' => Reservation::where('user_id', $userId)
                ->whereHas('route', function($query) {
                    $query->where('fecha_salida', '<', now());
                })
                ->count()
        ];

        // Obtener rutas recomendadas
        $recommendedRoutes = Route::where('estado', true)
            ->where('fecha_salida', '>', now())
            ->where('asientos_disponibles', '>', 0)
            ->orderBy('fecha_salida')
            ->take(3)
            ->get();

        return view('dashboard', compact('upcomingReservations', 'stats', 'recommendedRoutes'));
    }
}
