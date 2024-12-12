<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'route_id',
        'estado',
        'num_pasajeros',
        'total',
        'notas',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'num_pasajeros' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            'pendiente' => 'warning',
            'confirmada' => 'success',
            'cancelada' => 'danger',
        ][$this->estado] ?? 'secondary';
    }

    public function getStatusTextAttribute()
    {
        return ucfirst($this->estado);
    }
}
