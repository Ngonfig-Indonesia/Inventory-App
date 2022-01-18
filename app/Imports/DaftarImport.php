<?php

namespace App\Imports;

use App\Models\DaftarItem;
use Maatwebsite\Excel\Concerns\ToModel;

class DaftarImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DaftarItem([
            'kode_barang' => $row[0],
            'barcode' => $row[1],
            'nama_barang' => $row[2],
            'qty' => $row[3],
        ]);
    }
}
