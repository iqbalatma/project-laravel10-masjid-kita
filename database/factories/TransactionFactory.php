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
            "method" => fake()->randomElement(["income", "expense"]),
            "mosque_id" => fake()->numberBetween(1, 10),
            "transaction_type_id" => fake()->numberBetween(1, 5),
            "user_id" => 1,
            "status" => fake()->randomElement(["pending", "approved", "rejected"]),
            "status_changed_by" => 1,
            "created_at" => fake()->dateTimeBetween("2023-05-01"),
        ];
    }
}
