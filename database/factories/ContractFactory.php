<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => fake()->randomElement(['1', '2']),
            'contract_type_id' => fake()->randomElement(['1', '2', '3']),
            'date_from' => fake()->dateTime(),
            'date_to' => fake()->dateTime(),
            'salary_per_day' => fake()->numberBetween(10, 40),
        ];
    }
}
