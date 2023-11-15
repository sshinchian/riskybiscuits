<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkSlot;
use App\Models\WorkSlotBid;

class WorkslotBidTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use WithFaker;


    public function test_user_can_make_a_bid()
    {
        $user = User::where('email', 'staff4@gmail.com')->first();
        $user->update(['password' => bcrypt('111')]);

        $this->actingAs($user);

        $workSlot = WorkSlot::create([
            'time_slot_name' => 'TestTimeSlotName',
            'start_date' => '2023-11-10',
            'end_date'=> '2023-11-10',
            'start_time'=> '11:00:00',
            'end_time'=> '12:00:00',
            'staff_role_id' => $user->staff_role_id,
            'quantity'=> '10',
        ]);

        // Make a bid
        $response = $this->post(route('workslotbids.store'), [
            'work_slot_id' => $workSlot->id,
            'user_id' => $user->id,
        ]);

        // Assert the bid was successful
        $response->assertRedirect(route('workslotbids.create'))
            ->assertSessionHas('success', 'Bid Created Successfully.');
    
        $this->assertDatabaseHas('work_slot_bids', [
            'work_slot_id' => $workSlot->id,
            'user_id' => $user->id,
            'status' => '0',
        ]);
    }


    public function test_user_can_delete_a_bid()
    {
        // Retrieve the existing user from the database
        $user = User::where('email', 'staff4@gmail.com')->first();

        // Set the password for testing purposes
        $user->update(['password' => bcrypt('111')]);

        // Bypass authentication middleware
        $this->withoutMiddleware();

        // Authenticate the user
        $this->actingAs($user);

        $workSlot = WorkSlot::create([
            'time_slot_name' => 'TestTimeSlotName2',
            'start_date' => '2023-11-10',
            'end_date'=> '2023-11-10',
            'start_time'=> '11:00:00',
            'end_time'=> '12:00:00',
            'staff_role_id' => $user->staff_role_id,
            'quantity'=> '10',
        ]);

        // Manually insert a bid for the work slot
        $workSlotBid = WorkSlotBid::create([
            'work_slot_id' => $workSlot->id,
            'user_id' => $user->id,
            'status' => '0', // Assuming '0' is the default status for a new bid
        ]);

        // Delete the bid
        $response = $this->delete(route('workslotbids.destroy', $workSlotBid->id));

        // Assert the bid was deleted successfully
        $response->assertRedirect(route('workslotbids.index'))
            ->assertSessionHas('success', 'Workslot deleted successfully.');
    }


}
