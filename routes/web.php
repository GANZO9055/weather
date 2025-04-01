<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'showLogin'])
    ->name('login.form');
Route::post('/login', [UserController::class, 'login'])
    ->name('login');
Route::get('/register', [UserController::class, 'showRegister'])
    ->name('register.form');
Route::post('/register', [UserController::class, 'create'])
    ->name('register');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/locations', [LocationController::class, 'index'])
        ->name('locations.index');
    Route::get('/locations/create', [LocationController::class, 'createLocation'])
        ->name('locations.index.create');
    Route::post('/create', [LocationController::class, 'create'])
        ->name('locations.create');
    Route::delete('/locations/{id}', [LocationController::class, 'delete'])
        ->name('locations.delete');
});
