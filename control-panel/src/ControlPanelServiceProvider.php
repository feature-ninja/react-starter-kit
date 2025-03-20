<?php

declare(strict_types=1);

namespace ControlPanel;

use App\Assets\Facades\Bundle;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class ControlPanelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->configureBundle();
        $this->configureViews();
    }

    private function configureViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cp');
    }

    private function configureBundle(): void
    {
        Bundle::register('control-panel', __DIR__.'/../');
    }

    public function register(): void
    {
        VerifyEmail::createUrlUsing(function (User $user) {
            return URL::temporarySignedRoute(
                'cp.verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $user->getKey(),
                    'hash' => sha1($user->getEmailForVerification()),
                ],
            );
        });
    }
}
