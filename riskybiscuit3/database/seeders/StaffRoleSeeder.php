<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffRoles;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaffRoles::create([
            'name' => 'Chef',
            'role_id' => '4'
        ]);

        StaffRoles::create([
            'name' => 'Waiter',
            'role_id' => '4'
        ]);

        StaffRoles::create([
            'name' => 'Cashier',
            'role_id' => '4'
        ]);

    }
}
