<?php

declare(strict_types=1);

namespace App\Assets;

final readonly class RegisteredBundle
{
    public function __construct(
        public string $name,
        public string $path,
    ) {}
}
