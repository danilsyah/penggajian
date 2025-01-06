<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePolaKerjaKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pola_kerja_karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 255);
            $table->date('tanggal');
            $table->integer('pola_kerja_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pola_kerja_karyawan');
    }
}
