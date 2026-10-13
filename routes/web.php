<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SsoController;
use App\Http\Controllers\ProfileController; // Or whichever controller handles your setup form

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
| First-Time Setup Routes
|--------------------------------------------------------------------------
| Users must be logged in via AD, but their profile might be incomplete.
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile/setup', [ProfileController::class, 'edit'])->name('profile.setup');
    Route::post('/profile/setup', [ProfileController::class, 'update'])->name('profile.setup.store');
});

/*
|--------------------------------------------------------------------------
| Fully Authenticated User Routes (Dashboard & SSO)
|--------------------------------------------------------------------------
| Users must be logged in AND have completed their profile setup.
*/

Route::middleware(['auth', \App\Http\Middleware\EnsureProfileIsComplete::class])->group(function () {
    
    Route::get('/dashboard', [
        DashboardController::class, 
        'index'
    ])->name('dashboard');

    Route::get('/sso/launch/{code}', [
        SsoController::class, 
        'launch'
    ])->name('sso.launch');

});