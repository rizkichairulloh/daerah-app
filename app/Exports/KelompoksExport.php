<?php

namespace App\Exports;

use App\Models\Kelompok;
use Maatwebsite\Excel\Concerns\FromCollection;

class KelompoksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kelompok::all();
    }
}
