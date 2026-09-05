<?php

namespace Tests\Feature;

use App\Models\Memory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_comment_on_a_memory(): void
    {
        $memory = Memory::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('memories.comments.store', $memory), [
            'content' => 'Smukt skrevet.',
        ])->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'memory_id' => $memory->id,
            'user_id' => $user->id,
            'content' => 'Smukt skrevet.',
        ]);
    }
}
