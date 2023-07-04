<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;

Route::get('/', static fn () => response()
    ->json([
        'App' => config('app.name'),
        'Version' => '2023.1.0',
        'Time' => time()
    ]));


Route::post('login', LoginController::class)->name('auth:login');
Route::post('register', RegistrationController::class)->name('auth:register');