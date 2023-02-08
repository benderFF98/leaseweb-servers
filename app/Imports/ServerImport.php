<?php

namespace App\Imports;

use App\Models\Server;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ServerImport implements ToModel, WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Server([
            'model' => $row[0],
            'ram' => $row[1],
            'hdd' => $row[2],
            'location' => $row[3],
            'price' => preg_replace('/[^0-9.]/','',$row[4])
        ]);
    }
}
