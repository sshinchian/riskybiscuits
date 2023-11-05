<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //CafeOwner Role Permissions
        $cafeownerpermissions=[
            'workslot-list',
            'workslot-create',
            'workslot-edit',
            'workslot-delete',
            'staffrole-list',
            'staffrole-create',
            'staffrole-edit',
            'staffrole-delete',
        ];
        //Create CafeOwner Role Permissions
        foreach($cafeownerpermissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        //All Current Permissions ID
        $permissions_saved = Permission::pluck('id')->toArray();
        
        //Assign CafeOwner Role Workslot and Staffrole Permissions
        $role = Role::whereId(2)->first();
        $role->syncPermissions($permissions_saved);
        
        //CafeOwner Role Sync Permission
        $user = User::where('role_id', 2)->first();
        $user->assignRole($role->id);


        //Manager Permissions
        $managerpermissions=[
            'staffworkslot-list',
            'staffworkslot-create',
            'staffworkslot-edit',
            'staffworkslot-delete',
            'workslotbid-list',
            'workslotbid-create',
            'workslotbid-edit',
            'workslotbid-delete',
            'staffrolebid-list',
            'staffrolebid-create',
            'staffrolebid-edit',
            'staffrolebid-delete',
        ];
        foreach($managerpermissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        //Only StaffWorkslot permissions
        $permissions_saved =[];
        foreach(Permission::all() as $permission){
            if(str_contains($permission->name, 'staffworkslot')||(str_contains($permission->name, 'bid')))
                array_push($permissions_saved,$permission->id);
        }
        //Assign Manager Role staffworkslot permissions
        $role = Role::whereId(3)->first();
        $role->syncPermissions($permissions_saved);
        
        //Manager Role Sync Permission
        $user = User::where('role_id', 3)->first();
        $user->assignRole($role->id);

        //Only bidding permissions for CafeStaff
        $permissions_saved =[];
        foreach(Permission::all() as $permission){
            if(str_contains($permission->name, 'bid'))
                array_push($permissions_saved,$permission->id);
        }

        //Assign CafeStaff Role Workslot and Staffrole Permissions
        $role = Role::whereId(4)->first();
        $role->syncPermissions($permissions_saved);
        
        //CafeStaff Role Sync Permission
        $user = User::where('role_id', 4)->first();
        $user->assignRole($role->id);


        //SuperAdmin Permissions
        $adminpermissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-create',
            'role-edit',
            'role-list',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

        ];
        foreach($adminpermissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        //All Permissions ID
        $permissions_saved = Permission::pluck('id')->toArray();
        
        //Assign SuperAdmin Role all permissions
        $role = Role::whereId(1)->first();
        $role->syncPermissions($permissions_saved);
        
        //Admin Role Sync Permission
        $user = User::where('role_id', 1)->first();
        $user->assignRole($role->id);
    }
}
