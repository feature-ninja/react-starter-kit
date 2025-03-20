<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Assets\Facades\Bundle;
use Illuminate\Console\Command;

final class BundleCommand extends Command
{
    protected $signature = 'bundle
        {--only= : Only execute commands for a specific bundle}
        {--ci|clean-install : Do a clean install}
        {script : The NPM script that we want to run}';

    protected $description = 'Build bundles';

    public function handle(): int
    {
        Bundle::only($this->only())
            ->install($this->cleanInstall())
            ->wait()
            ->run($this->script())
            ->wait();

        return 0;
    }

    private function only(): ?array
    {
        $only = str($this->option('only'))
            ->trim()
            ->explode(',')
            ->reject(fn (string $value) => $value === '');

        if ($only->isEmpty()) {
            return null;
        }

        return $only->all();
    }

    private function cleanInstall(): bool
    {
        return (bool) $this->option('clean-install');
    }

    private function script(): string
    {
        return (string) $this->argument('script');
    }
}
