<?php

namespace Tests\Feature;

use App\Models\MemorialPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemorialPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_memorial_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('memorial-pages.store'), [
            'full_name' => 'Bent Nielsen',
        ]);

        $page = MemorialPage::firstWhere('full_name', 'Bent Nielsen');

        $this->assertNotNull($page);
        $this->assertSame($user->id, $page->user_id);
        $response->assertRedirect(route('memorial-pages.show', $page));
    }

    public function test_authenticated_user_can_view_a_memorial_page(): void
    {
        $page = MemorialPage::factory()->create(['full_name' => 'Anna Hansen']);

        $this->actingAs(User::factory()->create())
            ->get(route('memorial-pages.show', $page))
            ->assertOk()
            ->assertSee('Anna Hansen');
    }
}
