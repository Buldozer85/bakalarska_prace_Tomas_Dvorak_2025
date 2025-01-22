<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Reservation $reservation): bool
    {
        return $user->id == $reservation->user_id || $user->is_admin;
    }

    public function viewOnProfile(User $user, Reservation $reservation): bool
    {
        return $user->id == $reservation->user_id;
    }

    public function update(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id || $user->is_admin;
    }

    public function cancel(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id || $user->is_admin;
    }

    public function confirm(User $user, Reservation $reservation): bool
    {
        return $user->is_admin && ! inPast($reservation->date, now());
    }
}
