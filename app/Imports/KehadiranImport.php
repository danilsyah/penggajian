<?php

namespace App\Imports;

use App\Kehadiran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KehadiranImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Kehadiran([
            'nik'                   => $row['nik'],
            'tanggal_masuk'         => $row['tanggal_masuk'],
            'tanggal_pulang'        => $row['tanggal_pulang'],
            'kode_status_kehadiran' => $row['kode_status_kehadiran']
        ]);
    }
}
