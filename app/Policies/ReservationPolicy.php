<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Reservation $reservation)
    {
        return $user->id === $reservation->user_id || $user->is_admin;
    }

    public function delete(User $user, Reservation $reservation)
    {
        return $user->id === $reservation->user_id || $user->is_admin;
    }
}
