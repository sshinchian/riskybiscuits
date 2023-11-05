<?php

namespace Database\Seeders;

use App\Models\StaffRoleBid;
use DateTime;
use Illuminate\Database\Seeder;

class StaffRoleBidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    

    public function run()
    {
        // Create Workslot
        $workslot = StaffRoleBid::create([
            'cafe_id' => 1,
            'staff_role_id'=> 1,
            'user_id' => 4,
            'status' => 0,
        ]);

        $workslot = StaffRoleBid::create([
            'cafe_id' => 1,
            'staff_role_id'=> 2,
            'user_id' => 5,
            'status' => 0,
        ]);
        $workslot = StaffRoleBid::create([
            'cafe_id' => 1,
            'staff_role_id'=> 3,
            'user_id' => 6,
            'status' => 0,
        ]);
    }
}
