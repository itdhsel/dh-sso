<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


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


});