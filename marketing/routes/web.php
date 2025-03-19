<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Marketing\Http\Features\Welcome\WelcomeController;

Route::middleware('web')
    ->group(function () {
        Route::get('/', WelcomeController::class)->name('marketing.welcome');
    });
