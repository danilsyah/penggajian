<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomponenGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponen_gaji', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('kode_komponen', 255);
            $table->string('nama_komponen', 255);
            $table->enum('jenis', ['tunjangan', 'potongan']);
            $table->integer('nilai');
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
        Schema::dropIfExists('komponen_gajis');
    }
}
