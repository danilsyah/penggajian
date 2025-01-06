<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolaKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pola_kerja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pola_kerja')->nullable();
            $table->string('jam_masuk', 5)->nullable();
            $table->string('jam_pulang', 5)->nullable();
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
        Schema::dropIfExists('pola_kerjas');
    }
}
