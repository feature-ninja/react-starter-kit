<?php

declare(strict_types=1);

namespace ControlPanel\Http\Features\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class DashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guests_are_redirected_to_the_login_page(): void
    {
        $this->get(route('cp.dashboard'))->assertRedirect(route('cp.login'));
    }

    #[Test]
    public function authenticated_users_can_visit_the_dashboard(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->get(route('cp.dashboard'))->assertOk();
    }
}
