<?php

declare(strict_types=1);

use ControlPanel\Http\Features\Settings\Appearance\AppearanceController;
use ControlPanel\Http\Features\Settings\Password\PasswordController;
use ControlPanel\Http\Features\Settings\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('cp.profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('cp.profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('cp.profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('cp.password.edit');
    Route::put('settings/password', [PasswordController::class, 'update'])->name('cp.password.update');

    Route::get('settings/appearance', [AppearanceController::class, 'edit'])->name('cp.appearance.edit');
});
