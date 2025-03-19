<?php

declare(strict_types=1);

namespace ControlPanel;

use App\Assets\Facades\Bundle;
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
}
