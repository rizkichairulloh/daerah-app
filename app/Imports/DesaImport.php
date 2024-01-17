<?php

namespace App\Imports;

use App\Models\Desa;
use Maatwebsite\Excel\Concerns\ToModel;

class DesaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Desa([
            'name' => $row[1],
            'koordinator' => $row[2],
        ]);
    }
}
