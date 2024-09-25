<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PageController;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('homepage');
    Route::get('/kontakt', 'contact')->name('contact');
});

/*Route::controller(AuthController::class)->group(function () {
    Route::get('/prihlaseni', 'showLoginPage')->name('show-login-page');
    Route::get('/registrace', 'showRegistrationPage')->name('show-registration-page');
    Route::post('/register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::get('/odhlasit-se', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/ucet', 'profile')->name('profile');
        Route::post('/zmena-osobnich-udaju', 'updateInformation')->name('update-information');
    });
});*/
