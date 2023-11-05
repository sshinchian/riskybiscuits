<?php

namespace App\Imports;

use App\Models\WorkSlot;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WorkslotImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $workslot = new WorkSlot([
            "time_slot_name" => $row['time_slot_name'],
            "start_date" => $row['start_date'],
            "end_date" => $row['end_date'],
            "start_time" => $row['start_time'],
            "end_time" => $row['end_time'],
            "staff_role_id" => $row['staff_role_id'],
            "quantity" => $row['quantity'],
        ]);


        return $workslot;
    }
}
