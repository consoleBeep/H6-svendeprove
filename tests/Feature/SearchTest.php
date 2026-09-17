<?php

namespace Tests\Feature;

use App\Livewire\MemorialPageSearch;
use App\Models\MemorialPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_filters_memorial_pages_by_name(): void
    {
        MemorialPage::factory()->create(['full_name' => 'Anna Hansen']);
        MemorialPage::factory()->create(['full_name' => 'Bent Nielsen']);

        Livewire::test(MemorialPageSearch::class)
            ->set('query', 'anna')
            ->assertSee('Anna Hansen')
            ->assertDontSee('Bent Nielsen');
    }
}
