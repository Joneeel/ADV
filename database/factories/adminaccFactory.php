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
/* Creating a new adminacc with the following attributes:
- name: lastName
- username: username
- password: password
- status: Y */
        return [
            'name' => $this->faker->lastName,
            'username' => $this->faker->username,
            'password' => $this->faker->password,
            'status' => 'Y',
        ];
    }
}
