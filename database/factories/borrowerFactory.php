<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class borrowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender=['Male','Female'];
        $status=['Active','NotActive'];
        $now = \Carbon\Carbon::now();

        return [
            'fullname' => $this->faker->name(),
            'gender' => $gender[random_int(0,1)],
            'status' => $status[random_int(0,1)],
            'address' => $this->faker->address(),
            'resetmonth' => $now->month,
        ];
    }
}
