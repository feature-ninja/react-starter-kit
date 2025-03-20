<?php

declare(strict_types=1);

namespace App\Assets\Npm;

use App\Assets\NpmCommand;
use App\Assets\RegisteredBundle;
use Illuminate\Process\InvokedProcess;
use Illuminate\Support\Facades\Process;

final readonly class Install implements NpmCommand
{
    public function __construct(
        private bool $tty,
        private bool $clean,
    ) {}

    public function __invoke(RegisteredBundle $bundle): InvokedProcess
    {
        $command = $this->clean
            ? 'npm clean-install'
            : 'npm install';

        return Process::path($bundle->path)
            ->tty($this->tty)
            ->forever()
            ->start($command);
    }
}
