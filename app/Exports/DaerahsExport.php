<?php

namespace App\Exports;

use App\Models\Daerah;
use Maatwebsite\Excel\Concerns\FromCollection;

class DaerahsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Daerah::all();
    }
}
