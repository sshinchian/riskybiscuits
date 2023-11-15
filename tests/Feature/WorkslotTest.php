<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\WorkSlot;

class WorkslotTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_workslots_route_return_ok()
    {
        $response = $this->post('/login',[
            'email'=> 'superadmin@gmail.com',
            'password' => '111'
           ]);

        $response = $this->get('/workslots');
        $response->assertStatus(200);
    }

    /* public function test_create_new_workslot(){

        $response = $this->post('/login',[
            'email'=> 'superadmin@gmail.com',
            'password' => '111'
           ]);

           $workslot = WorkSlot::create([
            'time_slot_name' => 'TestTimeSlotName',
            'start_date' => '2023-11-10',
            'end_date'=> '2023-11-10',
            'start_time'=> '11:00:00',
            'end_time'=> '12:00:00',
            'staff_role_id'=> '2',
            'quantity'=> '2',
        ]);

        $this->assertNotEmpty($workslot->time_slot_name);
    } */

    /* public function test_edit_existing_workslot(){

        $response = $this->post('/login',[
            'email'=> 'superadmin@gmail.com',
            'password' => '111'
           ]);

        $workslot = WorkSlot::first();

        dump($workslot->toArray());

        $response = $this->put('/workslots/edit' . $workslot->id, [
            'start_time' => '11:00:00'
        ]);

        dump($workslot->toArray());
        dump($workslot->id);

        $workslot->refresh();
        $this->assertEquals('11:00:00', $workslot->start_time);
    } */

}
