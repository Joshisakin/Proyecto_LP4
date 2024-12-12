<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\Schedule;
use Carbon\Carbon;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        // Rutas de transporte fluvial
        $routes = [
            [
                'origin' => 'Iquitos',
                'destination' => 'Yurimaguas',
                'price' => 150.00,
                'boat_type' => 'Ferry Grande',
                'available_seats' => 50,
                'departure_time' => Carbon::now()->addDays(10)->toDateTimeString(),
                'duration_hours' => 12
            ],
            [
                'origin' => 'Pucallpa',
                'destination' => 'Contamana',
                'price' => 100.00,
                'boat_type' => 'Lancha Rápida',
                'available_seats' => 30,
                'departure_time' => Carbon::now()->addDays(15)->toDateTimeString(),
                'duration_hours' => 6
            ],
            [
                'origin' => 'Nauta',
                'destination' => 'Requena',
                'price' => 80.00,
                'boat_type' => 'Barco Mediano',
                'available_seats' => 40,
                'departure_time' => Carbon::now()->addDays(20)->toDateTimeString(),
                'duration_hours' => 8
            ]
        ];

        foreach ($routes as $routeData) {
            $route = Route::create($routeData);

            // Crear horarios para cada ruta
            Schedule::create([
                'route_id' => $route->id,
                'departure_time' => $route->departure_time,
                'arrival_time' => Carbon::parse($route->departure_time)->addHours($route->duration_hours)->toDateTimeString()
            ]);
        }
    }
}
