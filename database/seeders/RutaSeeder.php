<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use Carbon\Carbon;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar rutas existentes
        Route::truncate();

        // Crear rutas de ejemplo
        $rutas = [
            [
                'origen' => 'Iquitos',
                'destino' => 'Nauta',
                'fecha_salida' => Carbon::now()->addDays(30)->setTime(8, 0),
                'fecha_llegada' => Carbon::now()->addDays(30)->setTime(12, 0),
                'precio' => 50.00,
                'capacidad' => 50,
                'asientos_disponibles' => 50,
                'duracion' => 4.0, // 4 horas
                'estado' => true,
                'descripcion' => 'Ruta fluvial desde Iquitos a Nauta',
                'boat_type' => 'Lancha rápida',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'origen' => 'Yurimaguas',
                'destino' => 'Lagunas',
                'fecha_salida' => Carbon::now()->addDays(35)->setTime(10, 0),
                'fecha_llegada' => Carbon::now()->addDays(35)->setTime(14, 30),
                'precio' => 45.50,
                'capacidad' => 50,
                'asientos_disponibles' => 50,
                'duracion' => 4.5, // 4.5 horas
                'estado' => true,
                'descripcion' => 'Ruta fluvial desde Yurimaguas a Lagunas',
                'boat_type' => 'Bote de pasajeros',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'origen' => 'Pucallpa',
                'destino' => 'Puerto Bermúdez',
                'fecha_salida' => Carbon::now()->addDays(45)->setTime(7, 30),
                'fecha_llegada' => Carbon::now()->addDays(45)->setTime(13, 45),
                'precio' => 60.00,
                'capacidad' => 50,
                'asientos_disponibles' => 50,
                'duracion' => 6.25, // 6 horas y 15 minutos
                'estado' => true,
                'descripcion' => 'Ruta fluvial desde Pucallpa a Puerto Bermúdez',
                'boat_type' => 'Lancha rápida',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insertar las rutas
        Route::insert($rutas);
    }
}
