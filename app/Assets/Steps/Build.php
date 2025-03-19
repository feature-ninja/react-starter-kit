<?php

declare(strict_types=1);

namespace App\Assets\Steps;

use App\Assets\BundlerStep;
use App\Assets\RegisteredBundle;
use Illuminate\Contracts\Process\InvokedProcess;
use Illuminate\Support\Facades\Process;

final readonly class Build implements BundlerStep
{
    public function __construct(
        private bool $tty,
    ) {}

    public function __invoke(RegisteredBundle $bundle): InvokedProcess
    {
        return Process::path($bundle->path)
            ->tty($this->tty)
            ->forever()
            ->start('npm run build');
    }
}
