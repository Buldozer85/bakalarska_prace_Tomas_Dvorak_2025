<?php

use App\Models\ReservationTemp;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('model:prune', [
    '--model' => [ReservationTemp::class],
])->everyFifteenMinutes();

Schedule::command('php artisan reservations:delete-expired')->everyFifteenMinutes();
Schedule::command('php artisan reservations:send-upcoming-notification')->dailyAt(0);
