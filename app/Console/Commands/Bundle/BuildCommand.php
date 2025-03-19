<?php

declare(strict_types=1);

namespace App\Console\Commands\Bundle;

use App\Assets\Bundler;
use App\Assets\Facades\Bundle;
use App\Assets\RegisteredBundle;
use Illuminate\Console\Command;

final class BuildCommand extends Command
{
    protected $signature = 'bundle:build {bundle?} {--ci|clean-install : Do a clean install}';

    protected $description = 'Build bundles';

    public function handle(): int
    {
        $cleanInstall = (bool) $this->option('clean-install');

        Bundle::all()
            ->filter(fn (RegisteredBundle $bundle) => $this->shouldBuild($bundle))
            ->map(fn (RegisteredBundle $bundle) => Bundler::make($bundle))
            ->map->install($cleanInstall)
            ->map->wait()
            ->map->build()
            ->map->wait();

        return 0;
    }

    private function shouldBuild(RegisteredBundle $bundle): bool
    {
        $name = $this->argument('bundle');
        if ($name === null) {
            return true;
        }

        return $bundle->name === $name;
    }
}
