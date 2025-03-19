<?php

declare(strict_types=1);

use ControlPanel\Http\Features\IdentityAccess\Authentication\AuthenticatedSessionController;
use ControlPanel\Http\Features\IdentityAccess\EmailVerification\EmailVerificationNotificationController;
use ControlPanel\Http\Features\IdentityAccess\EmailVerification\EmailVerificationPromptController;
use ControlPanel\Http\Features\IdentityAccess\EmailVerification\VerifyEmailController;
use ControlPanel\Http\Features\IdentityAccess\PasswordConfirmation\ConfirmablePasswordController;
use ControlPanel\Http\Features\IdentityAccess\PasswordReset\NewPasswordController;
use ControlPanel\Http\Features\IdentityAccess\PasswordReset\PasswordResetLinkController;
use ControlPanel\Http\Features\IdentityAccess\Registration\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('cp.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('cp.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('cp.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('cp.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('cp.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('cp.password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('cp.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('cp.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('cp.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('cp.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('cp.logout');
});
