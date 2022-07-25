<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "number" => $this->faker->text(20),
            "year_made" => $this->faker->date,
            "model" => $this->faker->text(20),
            "price" => $this->faker->numberBetween(100, 1000),
        ];
    }
}
