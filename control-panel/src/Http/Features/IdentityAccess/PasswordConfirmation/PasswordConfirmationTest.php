<?php

declare(strict_types=1);

namespace ControlPanel\Http\Features\IdentityAccess\PasswordConfirmation;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('cp.password.confirm'));

        $response->assertStatus(200);
    }

    #[Test]
    public function password_can_be_confirmed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('cp.password.confirm'), [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    #[Test]
    public function password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('cp.password.confirm'), [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
