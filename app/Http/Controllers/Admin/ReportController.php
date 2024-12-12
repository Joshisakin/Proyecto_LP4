<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'total_users' => User::count(),
            'total_routes' => Route::count(),
            'total_reservations' => Reservation::count(),
            'total_revenue' => Reservation::where('status', 'confirmed')
                ->join('rutas', 'reservations.route_id', '=', 'rutas.id')
                ->sum('rutas.precio'),
        ];

        // Reservaciones por mes
        $reservationsByMonth = Reservation::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Rutas más populares
        $popularRoutes = Route::withCount('reservations')
            ->orderByDesc('reservations_count')
            ->limit(5)
            ->get();

        return view('admin.reports.index', compact('stats', 'reservationsByMonth', 'popularRoutes'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:sales,reservations,routes',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Aquí iría la lógica para generar reportes específicos
        // Por ahora retornamos a la vista principal
        return redirect()
            ->route('admin.reports.index')
            ->with('success', 'Reporte generado exitosamente');
    }
}
