<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_users_cannot_access_the_admin_panel(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'user']))
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_admins_can_access_the_admin_panel(): void
    {
        $this->actingAs(User::factory()->admin()->create())
            ->get('/admin')
            ->assertOk();
    }
}
