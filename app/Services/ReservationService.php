<?php

namespace App\Services;

use App\Models\Route;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationService
{
    public function getUserReservations(int $userId, string $estado): LengthAwarePaginator
    {
        $query = Reservation::where('user_id', $userId)->with('ruta');

        switch ($estado) {
            case 'activas':
                $query->whereIn('estado', ['pendiente', 'confirmado']);
                break;
            case 'canceladas':
                $query->where('estado', 'cancelado');
                break;
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function createReservation(int $userId, int $rutaId, int $cantidadPasajeros, ?string $comentarios): Reservation
    {
        $ruta = Route::findOrFail($rutaId);

        if ($ruta->asientos_disponibles < $cantidadPasajeros) {
            throw new \Exception("No hay suficientes asientos disponibles. Solo quedan {$ruta->asientos_disponibles} asientos.");
        }

        try {
            DB::beginTransaction();

            $reserva = Reservation::create([
                'user_id' => $userId,
                'ruta_id' => $rutaId,
                'fecha_viaje' => $ruta->fecha_salida,
                'cantidad_pasajeros' => $cantidadPasajeros,
                'precio_total' => $ruta->precio * $cantidadPasajeros,
                'estado' => 'pendiente',
                'comentarios' => $comentarios
            ]);

            $ruta->decrementSeats($cantidadPasajeros);

            DB::commit();
            return $reserva;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function cancelReservation(Reservation $reserva): void
    {
        if (!$reserva->canBeCancelled()) {
            throw new \Exception('Esta reserva no puede ser cancelada.');
        }

        try {
            DB::beginTransaction();

            $reserva->ruta->incrementSeats($reserva->cantidad_pasajeros);
            $reserva->update(['estado' => 'cancelado']);

            if ($reserva->pago && $reserva->pago->isCompleted()) {
                Payment::create([
                    'reservation_id' => $reserva->id,
                    'user_id' => $reserva->user_id,
                    'monto' => -$reserva->precio_total,
                    'metodoPago' => 'refund',
                    'estado' => 'completed',
                    'fechaPago' => now(),
                    'moneda' => 'PEN'
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteReservation(Reservation $reserva): void
    {
        if (!$reserva->isCancelled()) {
            throw new \Exception('Solo se pueden eliminar reservas canceladas.');
        }

        $reserva->delete();
    }

    public function searchRoutes(?string $origen, ?string $destino, ?string $fecha): Collection
    {
        $query = Route::query();

        if ($origen) {
            $query->where('origen', 'like', "%{$origen}%");
        }

        if ($destino) {
            $query->where('destino', 'like', "%{$destino}%");
        }

        if ($fecha) {
            $fecha = Carbon::parse($fecha)->startOfDay();
            $query->whereDate('fecha_salida', '>=', $fecha)
                  ->whereDate('fecha_salida', '<=', $fecha->copy()->endOfDay());
        } else {
            $query->where('fecha_salida', '>=', now());
        }

        return $query->available()->orderBy('fecha_salida')->get();
    }
} 