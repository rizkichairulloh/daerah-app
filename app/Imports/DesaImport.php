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
            'desa_id' => $row[1],
            'kelompok_id' => $row[2],
            'name' => $row[3],
            'koordinator' => $row[4],
        ]);
    }
}
