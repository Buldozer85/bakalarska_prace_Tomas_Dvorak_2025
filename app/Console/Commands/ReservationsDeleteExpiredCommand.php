<?php

namespace App\Console\Commands;

use App\Models\ReservationTemp;
use Illuminate\Console\Command;

class ReservationsDeleteExpiredCommand extends Command
{
    protected $signature = 'reservations:delete-expired';

    protected $name = 'reservations:delete-expired';

    protected $description = 'Checks and delete all expired temporary reservation';

    public function handle(): void
    {
        $tmpReservations = ReservationTemp::query()
            ->where('created_at', '>', now()->addMinutes(15))
            ->get();

        foreach ($tmpReservations as $reservation) {
            $reservation->delete();
        }

    }
}
