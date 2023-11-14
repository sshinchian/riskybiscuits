<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirect_to_dashboard_successfully() {

        User::factory()->create([
            "email"=> "superadmin@gmail.com",
            "password"=> bcrypt("password"),
        ]);


       $response = $this->post('/login',[
        'email'=> 'superadmin@gmail.com',
        'password' => 'password'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/home');
    }
}
