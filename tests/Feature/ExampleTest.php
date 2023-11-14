<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirect_to_dashboard_successfully() {

        User::factory()->create([

            'first_name'    => 'Super',
            'last_name'     => 'Admin',
            'email'         =>  'superadmin@gmail.com',
            'mobile_number' =>  '81818181',
            'password'      =>  Hash::make('111'),
            'role_id'       => 1

            /* "email"=> "superadmin@gmail.com",
             "password"=> bcrypt("password"), */
        ]);


       $response = $this->post('/login',[
        'email'=> 'superadmin@gmail.com',
        'password' => 'password'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/home');
    }
}
