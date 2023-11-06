<?php

namespace Database\Seeders;

use App\Models\WorkSlot;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class WorkSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $start_date = Carbon::createFromDate('2023', '11', '1');
        $end_date = Carbon::createFromDate('2023', '11', '1');
        $startTime = Carbon::createFromTime('7', '30', '0');
        $endTime = Carbon::createFromTime('13', '30', '0');
        // Create Workslot
        $workslot = WorkSlot::create([
            'time_slot_name' => 'AM Shift',
            'start_date' => $start_date,
            'end_date' =>$end_date,
            'start_time' => $startTime,
            'end_time' =>$endTime,
            'staff_role_id' => 1,
            'quantity' => 1,
        ]);
        $workslot = WorkSlot::create([
            'time_slot_name' => 'AM Shift',
            'start_date' => $start_date,
            'end_date' =>$end_date,
            'start_time' => $startTime,
            'end_time' =>$endTime,
            'staff_role_id' => 2,
            'quantity' => 1,
        ]);

        $workslot = WorkSlot::create([
            'time_slot_name' => 'AM Shift',
            'start_date' => $start_date,
            'end_date' =>$end_date,
            'start_time' => $startTime,
            'end_time' =>$endTime,
            'staff_role_id' => 3,
            'quantity' => 1,
        ]);
    }
}
