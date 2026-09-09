<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SsoController;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return auth()->check()
        ? to_route('dashboard')
        : to_route('login');

});



/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::get('/sso/launch/{code}', [
        SsoController::class,
        'launch'
    ])
    ->name('sso.launch');


});