<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Title' => $this->faker->unique()->word,
            'Author' => $this->faker->name,
            'Copyright' => $this->faker->name,
            'No_pages' => $this->faker->numberBetween($min = 100, $max = 500),
            'Stock' => $this->faker->numberBetween($min = 1, $max = 120),
        ];
    }
}
