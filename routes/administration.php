<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdministrationAccessMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdministrationAccessMiddleware::class)->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('/uzivatele', 'index')->name('users.index');
        Route::get('uzivatele/uzivatel/{user}', 'detail')->name('users.user.detail');
    });
    /*Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });*/
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/prihlaseni', 'loginPage')->name('login-page');
    Route::post('login', 'login')->name('login');
    Route::get('/odhlasit-se', 'logout')->name('logout');
});
