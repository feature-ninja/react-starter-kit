<?php

declare(strict_types=1);

namespace Marketing;

use App\Assets\Facades\Bundle;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class MarketingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->configureBundle();
        $this->configureViews();
    }

    private function configureViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'marketing');

        Blade::anonymousComponentNamespace(__DIR__.'/../resources/views/components', 'marketing');
        Blade::componentNamespace('Marketing\\View\\Components', 'marketing');
    }

    private function configureBundle(): void
    {
        Bundle::register('marketing', __DIR__.'/../');
    }
}
