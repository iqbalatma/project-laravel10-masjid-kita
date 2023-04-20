<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "description" => fake()->text(),
            "amount" => fake()->numberBetween(10000, 1000000000),
            "type" => fake()->randomElement(["infaq", "hibah", "wakaf", "iuran", "donasi", "zakat", "perawatan", "air", "listrik", "gaji", "operasional", "sumbangan"]),
            "method" => fake()->randomElement(["income", "expense"]),
            "mosque_id" => fake()->numberBetween(1, 10),
            "user_id" => 1
        ];
    }
}
