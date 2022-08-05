<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'detailed_results' => $this->faker->randomElement([true, false, null]),
            'public_results' => $this->faker->randomElement([true, false, null]),
        ];
    }
}
