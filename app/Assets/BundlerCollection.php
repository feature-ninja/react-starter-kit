<?php

declare(strict_types=1);

namespace App\Assets;

use Illuminate\Support\Collection;

/**
 * @extends Collection<string, Bundler>
 */
final class BundlerCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);

        $this->ensure(Bundler::class);
    }

    public function install(bool $cleanInstall): self
    {
        return $this->each->install($cleanInstall);
    }

    public function run(string $command, string ...$args): self
    {
        return $this->each->run($command, ...$args);
    }

    public function wait(): self
    {
        return $this->each->wait();
    }
}
