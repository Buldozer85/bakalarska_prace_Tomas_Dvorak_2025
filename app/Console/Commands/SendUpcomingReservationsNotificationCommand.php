<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Notifications\UpcomingReservationNotification;
use Illuminate\Console\Command;

class SendUpcomingReservationsNotificationCommand extends Command
{
    protected $signature = 'reservations:send-upcoming-notification';

    protected $description = 'Check and send upcoming reservations notification';

    public function handle(): void
    {
        $reservations = Reservation::unCancelled()
            ->with('user')
            ->whereNotNull('confirmed')
            ->where('date', '=', now()->addDay()->format('Y-m-d'))
            ->get();

        $this->info('Počet rezervací: '.$reservations->count());

        foreach ($reservations as $reservation) {
            $reservation->user->notify(new UpcomingReservationNotification($reservation));
        }
    }
}
