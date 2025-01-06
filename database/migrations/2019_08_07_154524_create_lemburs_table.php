<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periode', 255)->nullable();
            $table->string('nik', 255);
            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_pulang');
            $table->string('durasi_lembur');
            $table->integer('upah')->nullable();
            $table->integer('kalender_kerja_id')->nullable();
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
        Schema::dropIfExists('lemburs');
    }
}
