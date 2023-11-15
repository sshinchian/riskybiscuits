<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\WorkSlotBid;

class WorkslotBidTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_workslotbid_route_return_ok() {

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslotbids');
        $response->assertStatus(200);
    }

    public function test_create_new_workslotbid(){

        $response = $this->post('/login',[
            'email'=> 'staff4@gmail.com',
            'password' => '111'
           ]);

           $workslotbid = WorkSlotBid::create([
            'work_slot_id' => '107',
            'user_id' => '5',
            'status'=> '0'
        ]);
        
        $this->assertNotEmpty($workslotbid->id);
    }
}
