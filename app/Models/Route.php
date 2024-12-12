<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Route extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rutas';

    protected $fillable = [
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'precio',
        'capacidad',
        'asientos_disponibles',
        'duracion',
        'descripcion',
        'estado',
        'boat_type',
        'imagen',
    ];

    protected $casts = [
        'fecha_salida' => 'datetime',
        'fecha_llegada' => 'datetime',
        'precio' => 'decimal:2',
        'duracion' => 'float',
        'estado' => 'boolean',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'route_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('estado', true)
                    ->where('fecha_salida', '>', now())
                    ->where('asientos_disponibles', '>', 0);
    }

    public function getFormattedPrice()
    {
        return 'S/ ' . number_format($this->precio, 2);
    }

    public function getImageUrlAttribute()
    {
        // Si la ruta tiene una imagen específica, úsala
        if ($this->imagen && Storage::disk('public')->exists('rutas/' . $this->imagen)) {
            return asset('storage/rutas/' . $this->imagen);
        }

        // Obtener todas las imágenes jpg del directorio public/imagen
        $imagePath = public_path('imagen');
        $images = File::glob($imagePath . '/*.{jpg,jpeg,png}', GLOB_BRACE);

        if (empty($images)) {
            // Si no hay imágenes, retornar una imagen por defecto
            return asset('imagen/default.jpg');
        }

        // Seleccionar una imagen aleatoria
        $randomImage = basename($images[array_rand($images)]);

        return asset('imagen/' . $randomImage);
    }
}
