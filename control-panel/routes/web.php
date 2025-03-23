<?php

declare(strict_types=1);

use ControlPanel\Http\Features\Dashboard\DashboardController;
use ControlPanel\Http\Middleware\HandleAppearance;
use ControlPanel\Http\Middleware\HandleInertiaRequests;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Support\Facades\Route;

Route::prefix('cp')
    ->middleware([
        'web',
        HandleAppearance::class,
        HandleInertiaRequests::class,
        AddLinkHeadersForPreloadedAssets::class,
    ])
    ->group(function () {
        Route::middleware(['auth', EnsureEmailIsVerified::redirectTo('cp.verification.notice')])->group(function () {
            Route::redirect('/', '/cp/dashboard');
            Route::get('dashboard', DashboardController::class)->name('cp.dashboard');
        });

        require __DIR__.'/settings.php';
        require __DIR__.'/auth.php';
    });
