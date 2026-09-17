<?php

namespace Tests\Feature;

use App\Models\MemorialPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_lists_the_users_own_pages(): void
    {
        $user = User::factory()->create();
        $page = MemorialPage::factory()->for($user)->create(['full_name' => 'Anna Hansen']);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Anna Hansen');
    }
}
