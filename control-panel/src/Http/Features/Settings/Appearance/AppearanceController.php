<?php

declare(strict_types=1);

namespace ControlPanel\Http\Features\Settings\Appearance;

use Inertia\Inertia;
use Inertia\Response;

final readonly class AppearanceController
{
    /**
     * Show the user's appearance settings page.
     */
    public function edit(): Response
    {
        return Inertia::render('settings/appearance');
    }
}
