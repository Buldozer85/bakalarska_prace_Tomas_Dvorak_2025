<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case CANCELLED = 'cancelled';

    case CONFIRMED = 'confirmed';

    case WAITING = 'waiting';
}
