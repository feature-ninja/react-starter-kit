<?php

declare(strict_types=1);

namespace ControlPanel\Http\Features\IdentityAccess\Registration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function registration_screen_can_be_rendered(): void
    {
        $response = $this->get(route('cp.register'));

        $response->assertStatus(200);
    }

    #[Test]
    public function new_users_can_register(): void
    {
        $response = $this->post(route('cp.register'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('cp.dashboard', absolute: false));
        $this->assertAuthenticated();
    }
}
