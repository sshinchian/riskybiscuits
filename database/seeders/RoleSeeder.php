<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'CafeOwner',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Manager',
            'guard_name' => 'web',
        ]);
    }
}
