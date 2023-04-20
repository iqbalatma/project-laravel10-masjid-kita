<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MosqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "latitude" => fake()->latitude(),
            "longitude" => fake()->longitude(),
            "village_id" => fake()->numberBetween(1, 5),
            "area_wide" => fake()->numberBetween(200, 1000)
        ];
    }
}
