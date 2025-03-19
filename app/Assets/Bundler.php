<?php

declare(strict_types=1);

namespace App\Assets;

use App\Assets\Steps\Build;
use App\Assets\Steps\Dev;
use App\Assets\Steps\Install;
use Illuminate\Process\InvokedProcess;
use Symfony\Component\Process\Process;

final class Bundler
{
    private ?InvokedProcess $process = null;

    private function __construct(
        private readonly RegisteredBundle $bundle,
        private readonly bool $tty,
    ) {}

    public static function make(RegisteredBundle $bundle, ?bool $tty = null): self
    {
        return new self($bundle, match ($tty) {
            null => Process::isTtySupported(),
            default => $tty,
        });
    }

    public function wait(): self
    {
        $this->process
            ?->wait(function (string $type, string $text) {
                echo $text;
            })
            ->throw();

        $this->process = null;

        return $this;
    }

    public function install(bool $clean): self
    {
        return $this->run(new Install($this->tty, $clean));
    }

    public function build(): self
    {
        return $this->run(new Build($this->tty));
    }

    public function dev(): self
    {
        return $this->run(new Dev($this->tty));
    }

    private function run(callable $action): self
    {
        $this->process = $action($this->bundle);

        return $this;
    }
}
