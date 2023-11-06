<?php

namespace Database\Seeders;


use App\Models\Cafes;
use App\Models\WorkSlot;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            StaffRoleSeeder::class,
            WorkSlotSeeder::class,
            StaffRoleBidSeeder::class,
            WorkSlotBidSeeder::class,
        ]);

        Cafes::factory(5)->create();

    }
}
