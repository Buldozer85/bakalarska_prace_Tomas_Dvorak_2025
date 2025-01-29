<?php

use App\Models\ReservationTemp;

Schedule::command('model:prune', [
    '--model' => [ReservationTemp::class],
])->everyFifteenMinutes();

Schedule::command('php artisan reservations:send-upcoming-notification')->dailyAt(0);
