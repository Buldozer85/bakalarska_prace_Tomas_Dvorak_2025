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
            ->whereNull('cancelled')
            ->whereNotNull('confirmed')
            ->where('date', now()->addDay())
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->user->notify(new UpcomingReservationNotification($reservation));
        }
    }
}
