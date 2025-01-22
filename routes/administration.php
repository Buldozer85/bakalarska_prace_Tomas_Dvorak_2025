<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReservationAreaController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Middleware\AdministrationAccessMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdministrationAccessMiddleware::class)->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('/uzivatele', 'index')->name('users.index');
        Route::get('uzivatele/uzivatel/{user}', 'detail')->name('users.user.detail');
        Route::put('/uzivatele/uzivatel/{user}/update', 'update')->name('users.user.update');
        Route::get('/uzivatel/vytvorit', 'createPage')->name('users.user.createPage');
        Route::post('/uzivatel/create', 'create')->name('users.user.create');
        Route::delete('uzivatel/smazat/{user}', 'delete')->name('users.user.delete');

        Route::post('uzivatele/uzivatel/{user}/vytvorit-adresu', 'createAddress')->name('users.user.address.create');
        Route::put('uzivatele/uzivatel/{user}/uptavit-adresu', 'updateAddress')->name('users.user.address.update');

        Route::get('/profil', 'profile')->name('user.profile');
        Route::put('/profil/update', 'updateProfile')->name('user.profile.update');
        Route::put('/profil/adresa/update', 'updateProfileAddress')->name('user.profile.address.update');
        Route::post('/profil/adresa/create', 'createProfileAddress')->name('user.profile.address.create');
    });

    Route::controller(WebsiteSettingController::class)->group(function () {
        Route::get('/nastaveni-stranek', 'index')->name('websiteSetting.index');
        Route::get('nastaveni-stranek/nastaveni/{websiteSetting}', 'detail')->name('websiteSetting.detail');
        Route::get('/nastaveni-stranek/vytvorit', 'createPage')->name('websiteSetting.createPage');
        Route::post('/nastaveni-stranek/create', 'create')->name('websiteSetting.create');
        Route::put('nastaveni-stranek/{websiteSetting}/update', 'update')->name('websiteSetting.update');
    });

    Route::controller(ReservationController::class)->group(function () {
        Route::get('/rezervace', 'index')->name('reservation.index');
        Route::get('/rezervace/{reservation}', 'detail')->name('reservation.detail');
        Route::put('rezervace/{reservation}/upravit', 'update')->name('reservation.update');
        Route::get('/rezervace/{reservation}/zrusit', 'cancelReservation')
            ->can('cancel', 'reservation')
            ->name('reservation.cancelReservation');

        Route::get('/rezervace/{reservation}/potvrdit', 'confirmReservation')
            ->can('confirm', 'reservation')
            ->name('reservation.confirmReservation');

        Route::get('/rezervace/{reservation}/odpotvrdit', 'unConfirmReservation')
            ->can('confirm', 'reservation')
            ->name('reservation.unConfirmReservation');
    });

    Route::controller(ReservationAreaController::class)->group(function () {
        Route::get('/rezervacni-prostory', 'index')->name('reservationArea.index');
        Route::get('/rezrvacni-prostory/vytvorit', 'createPage')->name('reservationArea.createPage');
        Route::post('/rezrvacni-prostory/create', 'create')->name('reservationArea.create');
        Route::get('rezrvacni-prostory/upravit/{reservationArea}', 'updatePage')->name('reservationArea.updatePage');
        Route::put('rezrvacni-prostory/update/{reservationArea}', 'update')->name('reservationArea.update');
    });
    /*Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });*/
    Route::get('/odhlasit-se', [AuthController::class, 'logout'])->name('logout');

    Route::controller(ConversationController::class)->group(function () {
        Route::get('/konverzace', 'index')->name('conversations.index');
        Route::get('/konverzace/{conversation}', 'detail')->name('conversations.detail');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/prihlaseni', 'loginPage')->name('login-page');
    Route::post('login', 'login')->name('login');
});
