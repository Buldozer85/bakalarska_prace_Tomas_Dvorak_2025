<?php

use App\Console\Commands\SendUpcomingReservationsNotificationCommand;
use App\Models\ReservationTemp;

Schedule::command('model:prune', [
    '--model' => [ReservationTemp::class],
])->everyFifteenMinutes();

Schedule::command(SendUpcomingReservationsNotificationCommand::class)->dailyAt('00:00');
