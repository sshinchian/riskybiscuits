<?php

namespace App\Imports;

use App\Models\Cafes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CafesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $cafe = new Cafes([
            "name" => $row['name'],
            "address" => $row['address'],
            "mobile_number" => $row['mobile_number'],
        ]);


        return $cafe;
    }
}
