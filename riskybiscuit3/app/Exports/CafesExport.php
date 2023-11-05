<?php

namespace App\Exports;

use App\Models\Cafes;
use Maatwebsite\Excel\Concerns\FromCollection;

class CafesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cafes::all();
    }
}
