<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KalenderKerja extends Model
{
    protected $table = "kalender_kerja";

    // public function getTanggalAttribute($value)
    // {
    //     return date_format(date_create($value), "m-d-Y");
    // }
}
