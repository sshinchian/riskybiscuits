<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_manager_can_access_dashboard() {

        $response = $this->post('/login',[
            'email'=> 'manager@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function test_manager_can_access_staffrolebids() {

        $response = $this->post('/login',[
            'email'=> 'manager@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/staffrolebids');
        $response->assertStatus(200);
    }

    public function test_manager_can_view_workslotbids() {

        $response = $this->post('/login',[
            'email'=> 'manager@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslotbids');
        $response->assertStatus(200);
    }

    public function test_manager_can_access_offered_workslots() {

        $response = $this->post('/login',[
            'email'=> 'manager@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslotbids/offer');
        $response->assertStatus(200);
    }

    public function test_manager_can_view_requested_workslots_quantity() {

        $response = $this->post('/login',[
            'email'=> 'manager@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/users/slots');
        $response->assertStatus(200);
    }

}
