<?php

declare(strict_types=1);

namespace Marketing\Http\Features\Welcome;

use Illuminate\Contracts\View\View;

final readonly class WelcomeController
{
    public function __invoke(): View
    {
        return view('marketing::welcome');
    }
}
