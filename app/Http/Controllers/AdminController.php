<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Obtener datos de las tablas principales
        $users = DB::table('users')->get();
        $routes = DB::table('routes')->get();
        $bookings = DB::table('bookings')->get();

        return view('admin.dashboard', compact('users', 'routes', 'bookings'));
    }
}
