<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('/administrace')
                ->name('administration.')
                ->group(base_path('routes/administration.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/prihlaseni')->trustProxies('*');
    })
    ->withCommands([
        \App\Console\Commands\ReservationsDeleteExpiredCommand::class,
        \App\Console\Commands\SendUpcomingReservationsNotificationCommand::class,
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
