<?php

declare(strict_types=1);

namespace Marketing\Http\Features\Welcome;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function welcome_screen_can_be_rendered(): void
    {
        $this->get(route('marketing.welcome'))->assertOk();
    }
}
