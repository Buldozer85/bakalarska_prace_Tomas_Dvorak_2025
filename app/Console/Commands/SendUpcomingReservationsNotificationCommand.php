<?php

namespace App\Console\Commands;

use App\Mail\UpcomingReservationMail;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendUpcomingReservationsNotificationCommand extends Command
{
    protected $signature = 'reservations:send-upcoming-notification';

    protected $description = 'Check and send upcoming reservations notification';

    public function handle(): void
    {
        $reservations = Reservation::query()
            ->with('user')
            ->whereNull('cancelled')
            ->whereNotNull('confirmed')
            ->where('date', now()->addDay())
            ->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new UpcomingReservationMail($reservation));
        }
    }
}
