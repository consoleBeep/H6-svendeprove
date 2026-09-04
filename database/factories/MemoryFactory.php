<?php

namespace Database\Factories;

use App\Models\MemorialPage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Memory>
 */
class MemoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'memorial_page_id' => MemorialPage::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(2, true),
        ];
    }
}
