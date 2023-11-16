<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


//test1
class UserTest extends TestCase
{
    public function test_login_redirect_to_dashboard_successfully() {

       $response = $this->post('/login',[
        'email'=> 'superadmin@gmail.com',
        'password' => '111'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/home');
    }

    public function test_auth_user_can_access_dashboard(){
        
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
    }

    public function test_unauth_user_cannot_access_dashboard(){
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /* public function test_create_new_user(){

        $response = $this->post('/login',[
            'email'=> 'superadmin@gmail.com',
            'password' => '111'
           ]);

           $newUser = User::create([
            'first_name' => 'New Test',
            'last_name' => 'User',
            'email'=> 'newtestuser@gmail.com',
            'mobile_number'=> '',
            'password'=>  Hash::make('111'),
            'role_id'=> '4',
            'staff_role_id'=> '3',
            'status'=> '1'
        ]);

        $this->assertNotEmpty($newUser->first_name);
    } */

    
}
