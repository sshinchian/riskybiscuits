<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkSlot;
use App\Models\WorkSlotBid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkSlotBidFactory extends Factory
{

    public function definition()
    {
        //get random user
        $user=User::all()
                ->where('staff_role_id','!=',null)
                ->random();
        //get non-Rejected existingBids from random user 
        $existingBid = WorkSlotBid::query()
                    ->where('user_id', $user->id)
                    ->where('status', '>=', '0')
                    ->get();

        do{
            //get random Workslot
            $workslot = Workslot::query()
            ->where('staff_role_id',$user->staff_role_id)
            ->get()
            ->random();

            //add in to check workslotid
            $existingBid = $existingBid
                            ->where('work_slot_id', $workslot->id)
                            ->where('user_id', $user->id)
                            ->where('status', '>=', '0')
                            ->first();

        }while($existingBid);

        return [
            'user_id' => $user->id,
            'work_slot_id' => $workslot->id,
            'status' =>$this->faker->numberBetween(-1,3),
        ];
    }

}
