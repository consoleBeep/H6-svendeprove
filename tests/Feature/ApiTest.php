<?php

namespace Tests\Feature;

use App\Models\MemorialPage;
use App\Models\Memory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_memorial_pages_as_json(): void
    {
        MemorialPage::factory()->count(3)->create();

        $response = $this->getJson('/api/memorial-pages');

        $response->assertOk();
        $response->assertJsonCount(3, 'data');
        $response->assertJsonStructure([
            'data' => [['id', 'full_name', 'birth_date', 'url']],
        ]);
    }

    public function test_it_shows_a_single_memorial_page_as_json(): void
    {
        $page = MemorialPage::factory()->create(['full_name' => 'Anna Hansen']);

        $response = $this->getJson("/api/memorial-pages/{$page->id}");

        $response->assertOk();
        $response->assertJson([
            'data' => ['id' => $page->id, 'full_name' => 'Anna Hansen'],
        ]);
    }

    public function test_it_lists_memories_for_a_page_as_json(): void
    {
        $page = MemorialPage::factory()->create();
        Memory::factory()->count(2)->for($page)->create();

        $response = $this->getJson("/api/memorial-pages/{$page->id}/memories");

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
        $response->assertJsonStructure([
            'data' => [['id', 'title', 'content', 'author', 'created_at']],
        ]);
    }

    public function test_unknown_page_returns_404_json(): void
    {
        $response = $this->getJson('/api/memorial-pages/99999');

        $response->assertNotFound();
        $response->assertHeader('content-type', 'application/json');
    }
}
