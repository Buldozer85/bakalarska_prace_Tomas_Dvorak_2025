<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\LeagueController;
use App\Http\Controllers\Web\MessageController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ReservationController;
use App\Http\Middleware\Web\IsMemberOfLeagueMiddleware;
use App\Http\Middleware\Web\UnverifiedMiddleware;
use App\Livewire\Web\MakeReservation;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')
        ->name('homepage');

    Route::get('/kontakt', 'contact')
        ->name('contact');

    Route::get('/rezervace', 'reservation')
        ->name('reservation');

    Route::get('/kuzelkarska-liga', 'league')
        ->name('league');

    Route::get('/o-webu', 'aboutWeb')
        ->name('about-web');
});

Route::controller(AuthController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('/prihlaseni', 'index')
            ->name('show-login-page');

        Route::post('login', 'login')
            ->name('login');

        Route::get('/registrace', 'showRegistrationPage')
            ->name('show-registration-page');

        Route::post('/register', 'register')
            ->name('register');

        Route::get('/odhlasit-se', 'logout')
            ->withoutMiddleware('guest')
            ->middleware('auth')
            ->name('logout');

        // Handling of email verification
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')
            ->middleware(['auth', 'signed',  UnverifiedMiddleware::class])
            ->name('verification.verify');

        Route::post('/email/verification-notification', 'sendVerificationEmail')
            ->middleware(['auth', 'throttle:6,1',  UnverifiedMiddleware::class])
            ->name('verification.send');

        Route::get('/email/verify', 'verificationNotice')
            ->middleware(['auth', UnverifiedMiddleware::class])
            ->name('verification.notice');

        // Password reset
        Route::get('/zapomenute-heslo', 'forgotPasswordPage')
            ->middleware('guest')
            ->name('forgot-password-page.show');

        Route::post('/zapomenute-heslo-odeslat', 'sendResetPasswordEmail')
            ->middleware('guest')
            ->name('forgot-password-page.send-email');

        Route::get('/reset-hesla/{token}', 'resetPasswordPage')
            ->middleware('guest')
            ->name('password.reset');

        Route::post('/reset-password', 'resetPassword')
            ->middleware('guest')
            ->name('password.update');
    });

Route::prefix('/profil')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('profile');
            Route::get('/zmena-osobnich-udaju', 'editInformation')->name('profile.edit-information');
            Route::get('/zmena-hesla', 'editPassword')->name('profile.change-password.show');
            Route::get('/moje-rezervace', 'myReservations')->name('profile.my-reservations');
            Route::get('/moje-rezervace/{reservation}', 'myReservation')
                ->can('viewOnProfile', 'reservation')
                ->name('profile.my-reservations.my-reservation');
            Route::post('/update-information', 'changeInformation')->name('profile.update-information');
            Route::post('/change-password', 'changePassword')->name('profile.change-password');
            Route::get('/moje-liga', 'myLeague')
                ->middleware(IsMemberOfLeagueMiddleware::class)
                ->name('profile.my-league');
            Route::get('/konverzace', 'conversations')->name('profile.conversations');

        });

        Route::controller(ReservationController::class)->group(function () {
            Route::get('/moje-rezervace/{reservation}/zrusit', 'cancel')
                ->can('cancel', 'reservation')
                ->name('profile.my-reservations.my-reservation.cancel');

            Route::put('/moje-rezervace/{reservation}/upravit', 'updateReservation')
                ->can('update', 'reservation')
                ->name('profile.my-reservations.my-reservation.update');
        });

        Route::controller(LeagueController::class)
            ->prefix('/moje-liga')
            ->middleware(IsMemberOfLeagueMiddleware::class)
            ->group(function () {
                Route::get('/{league}', 'detail')
                    ->can('view', 'league')
                    ->can('view-only-with-rounds', 'league')
                    ->name('profile.user.league.detail');
            });

    });

Route::get('/rezervace/{reservation}/uspesne-vytvorena', [ReservationController::class, 'success'])
    ->can('view', 'reservation')
    ->name('reservation.success-page');

Route::get('/rezervace/vytvorit', MakeReservation::class)
    ->middleware('auth')
    ->name('reservation.show-create');

Route::controller(MessageController::class)
    ->group(function () {
        Route::post('/kontakt/odeslat-dotaz', 'send')->name('contact.message.send');
    });
