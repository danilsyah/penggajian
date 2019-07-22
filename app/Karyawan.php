<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = "karyawan";
    protected $primaryKey = "nik";
    public $incrementing = false;

    // public function getTanggalLahirAttribute($value){
    //     return date_format(date_create($value),"d-m-Y");
    // }

    // public function getTanggalMasukAttribute($value){
    //     return date_format(date_create($value),"d-m-Y");
    // }
}
