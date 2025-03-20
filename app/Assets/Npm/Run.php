<?php

declare(strict_types=1);

namespace App\Assets\Npm;

use App\Assets\NpmCommand;
use App\Assets\RegisteredBundle;
use Illuminate\Contracts\Process\InvokedProcess;
use Illuminate\Support\Facades\Process;

final readonly class Run implements NpmCommand
{
    /**
     * @param  list<string>  $args
     */
    public function __construct(
        private bool $tty,
        private string $command,
        private array $args,
    ) {}

    public function __invoke(RegisteredBundle $bundle): InvokedProcess
    {
        return Process::path($bundle->path)
            ->tty($this->tty)
            ->forever()
            ->start(['npm', 'run', $this->command, ...$this->args]);
    }
}
