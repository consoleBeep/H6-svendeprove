<?php

namespace Tests\Feature;

use App\Models\MemorialPage;
use App\Models\Memory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_post_a_memory(): void
    {
        $page = MemorialPage::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('memorial-pages.memories.store', $page), [
            'title' => 'En sommerdag',
            'content' => 'Jeg husker en tur til stranden.',
        ])->assertRedirect();

        $this->assertDatabaseHas('memories', [
            'memorial_page_id' => $page->id,
            'user_id' => $user->id,
            'title' => 'En sommerdag',
        ]);
    }

    public function test_guests_can_view_a_single_memory(): void
    {
        $memory = Memory::factory()->create([
            'title' => 'Titlen paa mindet',
            'content' => 'Indholdet af mindet.',
        ]);

        $this->get(route('memorial-pages.memories.show', [$memory->memorial_page_id, $memory]))
            ->assertOk()
            ->assertSee('Titlen paa mindet');
    }
}
