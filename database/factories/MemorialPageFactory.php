<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\MemorialPage>
 */
class MemorialPageFactory extends Factory
{
    public function definition(): array
    {
        $birthDate = fake()->dateTimeBetween('-95 years', '-55 years');
        $birthPlace = fake()->city();

        return [
            'user_id' => User::factory(),
            'full_name' => fake()->name(),
            'birth_date' => $birthDate,
            'birth_place' => $birthPlace,
            'death_date' => fake()->dateTimeBetween($birthDate, 'now'),
            'death_place' => fake()->city(),
            'grave_location' => fake()->randomElement(['Vestre', 'Østre', 'Nordre', 'Assistens']).' Kirkegård, '.$birthPlace,
            'life_story' => fake()->paragraphs(3, true),
        ];
    }
}
