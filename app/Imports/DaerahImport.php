<?php

namespace App\Imports;

use App\Models\Daerah;
use Maatwebsite\Excel\Concerns\ToModel;

class DaerahImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Daerah([
            //
        ]);
    }
}
