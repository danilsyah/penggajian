<?php
function cekKehadiran($nik, $tanggal)
{
    $kehadiran = \DB::table('kehadiran')
        ->where('nik', $nik)
        ->whereRaw("cast(tanggal_masuk as date) = '" . $tanggal . "'")
        ->first();
    if (isset($kehadiran)) {
        return $kehadiran->kode_status_kehadiran;
    } else {
        return '-';
    }
}

function cekLembur($nik, $tanggal)
{
    $lembur = \DB::table('lembur')
        ->where('nik', $nik)
        ->whereRaw("cast(tanggal_masuk as date) = '" . $tanggal . "'")
        ->first();
    if (isset($lembur)) {
        return $lembur->durasi_lembur;
    } else {
        return '-';
    }
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function bulan($bln)
{
    $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    $periode = $bulan[$bln];
    return $periode;
}

function hitungJmlKehadiran($nik, $periode)
{
    $sql = "select count(*) as jml_kehadiran from kehadiran where nik='$nik' and left(tanggal_masuk,7)='$periode'";
    $jmlKehadiran = \DB::select($sql);
    return $jmlKehadiran[0]->jml_kehadiran;
}

function zonaWaktu()
{
    return date_default_timezone_set("Asia/Jakarta");
}
