<?php

namespace Tests\Feature;

use App\Models\MemorialPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_upload_a_photo(): void
    {
        Storage::fake('public');
        $page = MemorialPage::factory()->create();

        $this->actingAs($page->user)->post(route('memorial-pages.photos.store', $page), [
            'photo' => UploadedFile::fake()->image('portrait.jpg'),
            'caption' => 'Sommer 1998',
        ])->assertRedirect(route('memorial-pages.show', $page));

        $photo = $page->photos()->first();

        $this->assertNotNull($photo);
        $this->assertSame('Sommer 1998', $photo->caption);
        Storage::disk('public')->assertExists($photo->path);
    }
}
