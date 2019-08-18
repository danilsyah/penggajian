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
            $table->string('nik', 10);
            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_pulang');
            $table->integer('durasi_lembur');
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
