<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el mes actual y el mes anterior
        $currentMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // Estadísticas de rutas
        $activeRoutes = Route::where('estado', true)->count();
        $lastMonthRoutes = Route::where('estado', true)
            ->whereMonth('created_at', $lastMonth->month)
            ->count();
        $routesChange = $lastMonthRoutes > 0
            ? (($activeRoutes - $lastMonthRoutes) / $lastMonthRoutes) * 100
            : 0;

        // Estadísticas de ingresos
        $totalRevenue = Reservation::select(DB::raw('SUM(total) as total'))
            ->where('estado', 'confirmada')
            ->whereMonth('created_at', $currentMonth->month)
            ->first()
            ->total ?? 0;

        $lastMonthRevenue = Reservation::select(DB::raw('SUM(total) as total'))
            ->where('estado', 'confirmada')
            ->whereMonth('created_at', $lastMonth->month)
            ->first()
            ->total ?? 0;

        $revenueChange = $lastMonthRevenue > 0
            ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;

        // Estadísticas de reservaciones
        $pendingReservations = Reservation::where('estado', 'pendiente')->count();
        $lastMonthPending = Reservation::where('estado', 'pendiente')
            ->whereMonth('created_at', $lastMonth->month)
            ->count();
        $reservationsChange = $lastMonthPending > 0
            ? (($pendingReservations - $lastMonthPending) / $lastMonthPending) * 100
            : 0;

        // Estadísticas de usuarios
        $totalUsers = User::count();
        $lastMonthUsers = User::whereMonth('created_at', $lastMonth->month)->count();
        $usersChange = $lastMonthUsers > 0
            ? (($totalUsers - $lastMonthUsers) / $lastMonthUsers) * 100
            : 0;

        $stats = [
            'active_routes' => $activeRoutes,
            'routes_change' => $routesChange,
            'total_revenue' => $totalRevenue,
            'revenue_change' => $revenueChange,
            'pending_reservations' => $pendingReservations,
            'reservations_change' => $reservationsChange,
            'total_users' => $totalUsers,
            'users_change' => $usersChange,
        ];

        // Últimas rutas con información adicional
        $latest_routes = Route::with(['reservations' => function($query) {
                $query->where('estado', 'confirmada');
            }])
            ->withCount(['reservations as confirmed_count' => function($query) {
                $query->where('estado', 'confirmada');
            }])
            ->latest()
            ->take(5)
            ->get();

        // Últimos usuarios con sus reservaciones
        $latest_users = User::with(['reservations' => function($query) {
                $query->where('estado', 'confirmada');
            }])
            ->withCount(['reservations as confirmed_count' => function($query) {
                $query->where('estado', 'confirmada');
            }])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_routes', 'latest_users'));
    }
}
