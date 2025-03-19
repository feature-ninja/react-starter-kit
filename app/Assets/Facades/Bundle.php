<?php

declare(strict_types=1);

namespace App\Assets\Facades;

use App\Assets\BundleManager;
use Illuminate\Support\Facades\Facade;

final class Bundle extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BundleManager::class;
    }
}
