<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => response()
    ->json([
        'App' => config('app.name'),
        'Version' => '2023.1.0',
        'Time' => time()
    ]));

Route::middleware('client.auth')->prefix('clients')->as('client:')
    ->group(static function (): void {
        Route::get('/')->name('list');
        Route::post('/')->name('register');
        Route::put('{ulid}')->name('update');
        Route::delete('{ulid}')->name('delete');

        Route::prefix('{ulid}')->group(static function (): void {
            Route::get('orders')->name('orders:list');
        });
    });
