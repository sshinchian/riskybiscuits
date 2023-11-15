<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\WorkSlot;

class OwnerTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_owner_can_access_dashboard() {

        $response = $this->post('/login',[
            'email'=> 'owner@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function test_owner_can_view_userlist() {

        $response = $this->post('/login',[
            'email'=> 'owner@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function test_owner_can_view_workslots() {

        $response = $this->post('/login',[
            'email'=> 'owner@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslots');
        $response->assertStatus(200);
    }

     public function test_owner_can_create_new_workslot(){

        $response = $this->post('/login',[
            'email'=> 'owner@gmail.com',
            'password' => '111'
           ]);

           $workslot = WorkSlot::create([
            'time_slot_name' => 'TestTimeSlotName22',
            'start_date' => '2023-11-10',
            'end_date'=> '2023-11-10',
            'start_time'=> '11:00:00',
            'end_time'=> '12:00:00',
            'staff_role_id'=> '2',
            'quantity'=> '2',
        ]);

        $this->assertNotEmpty($workslot->time_slot_name);
    }


    public function test_owner_can_delete_workslot()
    {
        $response = $this->post('/login', [
            'email' => 'owner@gmail.com',
            'password' => '111',
        ]);

        $response->assertStatus(302);
        $workSlot = WorkSlot::first();

        // If a work slot exists, proceed with the test
        if ($workSlot) {

            $response = $this->delete(route('workslot.destroy', $workSlot->id));
            $response->assertStatus(302);
            $response->assertRedirect(route('workslot.index'));
            $response->assertSessionHas('success', 'Workslot Deleted Successfully!.');

        } else {
            $this->markTestSkipped('No work slot found for testing.');
        }
    }
}
