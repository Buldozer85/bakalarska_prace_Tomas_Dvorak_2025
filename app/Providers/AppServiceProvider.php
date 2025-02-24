<?php

namespace App\Providers;

use App\Models\League;
use App\Models\Reservation;
use App\Models\User;
use App\Policies\ReservationPolicy;
use App\Policies\Web\MyLeaguePolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        if (! $this->app->environment('local')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Ověření e-mailové adresy')
                ->greeting('Dobrý den,')
                ->line('Pro potvrzení Vaší e-mailové adresy klikněte na tlačítko níže.')
                ->action('Ověřit e-mailovou adresu', $url)
                ->salutation('S pozdravem tým Kuželny Veselí');
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return route('password.reset', $token);

        });

        Gate::policy(Reservation::class, ReservationPolicy::class);
        Gate::policy(League::class, MyLeaguePolicy::class);

    }
}
