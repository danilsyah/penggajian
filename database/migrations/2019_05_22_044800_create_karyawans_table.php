<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('nik', 255);
            $table->string('nama', 255)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('kode_status_kawin', 255)->nullable();
            $table->string('jenis_kelamin', 1)->nullable();
            $table->integer('gaji_pokok')->nullable();
            $table->string('status_pegawai', 255)->nullable();
            $table->text('foto')->nullable();
            $table->string('kode_departemen', 255);
            $table->string('kode_jabatan', 255);
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
        Schema::dropIfExists('karyawan');
    }
}
