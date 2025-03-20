<?php

declare(strict_types=1);

namespace App\Assets;

use App\Assets\Npm\Install;
use App\Assets\Npm\Run;
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
        return $this->execute(new Install($this->tty, $clean));
    }

    public function run(string $command, string ...$args): self
    {
        return $this->execute(new Run($this->tty, $command, $args));
    }

    private function execute(callable $action): self
    {
        $this->process = $action($this->bundle);

        return $this;
    }
}
