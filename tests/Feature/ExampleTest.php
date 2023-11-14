<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirect_to_dashboard_successfully() {

       $response = $this->post('/login',[
        'email'=> 'superadmin@gmail.com',
        'password' => '111'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/home');
    }
}
