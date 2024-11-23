<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
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
    });

    Route::controller(WebsiteSettingController::class)->group(function () {
        Route::get('/nastaveni-stranek', 'index')->name('websiteSetting.index');
        Route::get('nastaveni-stranek/nastaveni/{websiteSetting}', 'detail')->name('websiteSetting.detail');
        Route::get('/nastaveni-stranek/vytvorit', 'createPage')->name('websiteSetting.createPage');
        Route::post('/nastaveni-stranek/create', 'create')->name('websiteSetting.create');
        Route::put('nastaveni-stranek/{websiteSetting}/update', 'update')->name('websiteSetting.update');
    });
    /*Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });*/
    Route::get('/odhlasit-se', [AuthController::class, 'logout'])->name('logout');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/prihlaseni', 'loginPage')->name('login-page');
    Route::post('login', 'login')->name('login');

});
