<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKawin extends Model
{
    protected $table = "status_kawin";
    protected $primaryKey = "kode_status_kawin";
    public $incrementing = false;
}
