<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'tried' => random_int(100, 200),
            'passed' => random_int(50, 99),
            'tags' => $this->faker->word() . ', ' . $this->faker->word() . ', ' . $this->faker->word() . ', ',
        ];
    }
}
