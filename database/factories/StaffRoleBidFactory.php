<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
class StaffRoleBidFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'staff_role_id' =>function (array $attributes){
                $staffRoleId = User::find($attributes['user_id'])->staff_role_id;
                if($staffRoleId == null)
                    return $this->faker->numberBetween(1,3);
                else
                    return $staffRoleId;
            },
            'status' => function(array $attributes){
                $staffRoleId= User::find($attributes['user_id'])->staff_role_id;
                if($staffRoleId == null)
                    return $this->faker->numberBetween(-1,0);
                else
                    return 1;
            },
        ];
    }

}
