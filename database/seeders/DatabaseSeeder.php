<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\MemorialPage;
use App\Models\Memory;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
        ]);

        $owner = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $visitors = User::factory(4)->create();

        MemorialPage::factory(6)
            ->recycle([$admin, $owner])
            ->create()
            ->each(function (MemorialPage $page) use ($visitors): void {
                Memory::factory(fake()->numberBetween(2, 5))
                    ->for($page)
                    ->recycle($visitors)
                    ->create()
                    ->each(function (Memory $memory) use ($visitors): void {
                        Comment::factory(fake()->numberBetween(0, 4))
                            ->for($memory)
                            ->recycle($visitors)
                            ->create();
                    });

                Photo::factory(fake()->numberBetween(0, 4))
                    ->for($page)
                    ->create(['user_id' => $page->user_id]);
            });
    }
}
