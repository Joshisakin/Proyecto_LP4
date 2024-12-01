<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RouteController extends Controller
{
    public function index(): View
    {
        $routes = Route::all();
        return view('routes.index', compact('routes'));
    }

    public function show(Route $route): View
    {
        return view('routes.show', compact('route'));
    }
}
