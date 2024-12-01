<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\Schedule;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        // Ruta Lima - Ica
        $limaIca = Route::create([
            'origin' => 'Lima',
            'destination' => 'Ica',
            'price' => 45.00,
        ]);

        Schedule::create([
            'route_id' => $limaIca->id,
            'departure_time' => '08:00:00',
            'arrival_time' => '12:00:00',
        ]);

        Schedule::create([
            'route_id' => $limaIca->id,
            'departure_time' => '14:00:00',
            'arrival_time' => '18:00:00',
        ]);

        // Ruta Lima - Huacho
        $limaHuacho = Route::create([
            'origin' => 'Lima',
            'destination' => 'Huacho',
            'price' => 25.00,
        ]);

        Schedule::create([
            'route_id' => $limaHuacho->id,
            'departure_time' => '09:00:00',
            'arrival_time' => '11:30:00',
        ]);

        Schedule::create([
            'route_id' => $limaHuacho->id,
            'departure_time' => '15:00:00',
            'arrival_time' => '17:30:00',
        ]);

        // Ruta Lima - Cañete
        $limaCañete = Route::create([
            'origin' => 'Lima',
            'destination' => 'Cañete',
            'price' => 35.00,
        ]);

        Schedule::create([
            'route_id' => $limaCañete->id,
            'departure_time' => '07:00:00',
            'arrival_time' => '10:00:00',
        ]);

        Schedule::create([
            'route_id' => $limaCañete->id,
            'departure_time' => '13:00:00',
            'arrival_time' => '16:00:00',
        ]);
    }
}
