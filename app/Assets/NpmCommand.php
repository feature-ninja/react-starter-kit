<?php

declare(strict_types=1);

namespace App\Assets;

use Illuminate\Contracts\Process\InvokedProcess;

interface NpmCommand
{
    public function __invoke(RegisteredBundle $bundle): InvokedProcess;
}
