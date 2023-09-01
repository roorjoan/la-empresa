<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tax_id_number' => fake()->numerify('#############'),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'birth_date' => fake()->date(),
            'email' => fake()->email(),
            'cell_phone' => fake()->phoneNumber(),
        ];
    }
}
