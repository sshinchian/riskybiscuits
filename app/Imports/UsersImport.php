<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User([
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email'],
            "mobile_number" => $row['mobile_number'],
            "password" => Hash::make('111'),
            "role_id" => $row['role_id'], // User Type User
            "status" => 1,
            
            "requested_workslots" => $row['requested_workslots'],
        ]);

        // Delete Any Existing Role
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            
        // Assign Role To User
        $user->assignRole($user->role_id);

        return $user;
    }
}
