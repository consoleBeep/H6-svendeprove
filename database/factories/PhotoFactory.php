<?php

namespace Database\Factories;

use App\Models\MemorialPage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'memorial_page_id' => MemorialPage::factory(),
            'user_id' => User::factory(),
            'path' => 'photos/placeholder-'.fake()->numberBetween(1, 9).'.jpg',
            'caption' => fake()->optional()->sentence(3),
        ];
    }
}
