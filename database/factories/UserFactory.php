<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'mobile_number' => $this->faker->randomElement([8,9]) . $this->faker->randomNumber(7,true),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('P@ssw0rd'. $this->faker->numberBetween(0, 20000000)), // password
            'remember_token' => Str::random(10),
            'role_id' => '4',
            'staff_role_id'=>$this->faker->randomElement([1,2,3,null]),
            'requested_workslots'=> 5
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
