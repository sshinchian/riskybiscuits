<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirect_to_dashboard_successfully() {

        /* $adminRole = optional(Role::where('name', 'SuperAdmin')->first())->id;
 */
        User::factory()->create([
            'first_name'    => 'Super',
            'last_name'     => 'Admin',
            'email'         =>  'superadmin2@gmail.com',
            'mobile_number' =>  '81818381',
            'password'      =>  Hash::make('password'),
            'role_id' => 1

        ]);


       $response = $this->post('/login',[
        'email'=> 'superadmin2@gmail.com',
        'password' => 'password'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/home');
    }
}