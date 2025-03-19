<?php

declare(strict_types=1);

namespace ControlPanel\Http\Features\Settings\Appearance;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class AppearanceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('cp.appearance.edit'));

        $response->assertOk();
    }
}
