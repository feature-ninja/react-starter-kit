<?php

declare(strict_types=1);

namespace App\Console\Commands\Bundle;

use App\Assets\Bundler;
use App\Assets\Facades\Bundle;
use App\Assets\RegisteredBundle;
use Illuminate\Console\Command;

final class DevCommand extends Command
{
    protected $signature = 'bundle:dev {bundle?} {--ci|clean-install : Do a clean install}';

    protected $description = 'Start dev server';

    public function handle(): int
    {
        $cleanInstall = (bool) $this->option('clean-install');

        Bundle::all()
            ->filter(fn (RegisteredBundle $bundle) => $this->shouldStartDevServer($bundle))
            ->map(fn (RegisteredBundle $bundle) => Bundler::make($bundle))
            ->map->install($cleanInstall)
            ->map->wait()
            ->map->dev()
            ->map->wait();

        return 0;
    }

    private function shouldStartDevServer(RegisteredBundle $bundle): bool
    {
        $name = $this->argument('bundle');
        if ($name === null) {
            return true;
        }

        return $bundle->name === $name;
    }
}
