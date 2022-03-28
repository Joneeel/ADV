<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class adminaccFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->username,
            'password' => $this->faker->password,
            'status' => 'Y',
        ];
    }
}
