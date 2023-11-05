<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CafesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address,
            'mobile_number' => $this->faker->phoneNumber,
        ];
    }
}
