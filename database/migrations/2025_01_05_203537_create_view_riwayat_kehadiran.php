<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewRiwayatKehadiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_riwayat_kehadiran AS
        SELECT k.id, k.nik, k.tanggal_masuk, k.tanggal_pulang, pk.pola_kerja, pk.jam_masuk, pk.jam_pulang
        FROM kehadiran AS k
        JOIN status_kehadiran AS sk ON k.kode_status_kehadiran = sk.kode_status_kehadiran
        LEFT JOIN pola_kerja_karyawan AS pkk ON pkk.nik = k.nik AND DATE(k.tanggal_masuk) = pkk.tanggal
        LEFT JOIN pola_kerja AS pk ON pk.id = pkk.pola_kerja_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_riwayat_kehadiran');
    }
}
