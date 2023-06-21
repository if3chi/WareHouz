<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => response()
    ->json([
        'App' => config('app.name'),
        'Version' => '2023.1.0',
        'Time' => time()
    ]));
