<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaffTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_staff_can_access_dashboard() {

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function test_staff_can_access_staffrolebids() {

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/staffrolebids');
        $response->assertStatus(200);
    }

    public function test_staff_can_access_mybids() {

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslotbids');
        $response->assertStatus(200);
    }

    public function test_staff_can_access_available_workslots() {

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslotbids/create');
        $response->assertStatus(200);
    }

    public function test_staff_can_access_offered_workslots() {

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslotbids/offer');
        $response->assertStatus(200);
    }
}
