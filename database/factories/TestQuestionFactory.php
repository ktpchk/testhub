<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['oneVariant', 'multiVariant', 'text']),
            'points' => random_int(0, 99),
        ];
    }
}
