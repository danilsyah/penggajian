<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gaji;

class GajiController extends Controller
{
    function index()
    {
        $periodeGaji = Session('periode_gaji');
        if ($periodeGaji == '') {
            $periode = date('Ym');
        } else {
            $periode = $periodeGaji;
        }
        $data['periodeGaji'] = Gaji::pluck('periode', 'periode');
        $data['riwayatGaji'] = Gaji::join('karyawan', 'gaji.nik', '=', 'karyawan.nik')
            ->where('gaji.periode', $periode)
            ->get();
        return view('gaji.index', $data);
    }

    function store(Request $request)
    {
        $request->validate([
            'periode' => 'required'
        ]);

        $periode = $request->periode;
        $data = [];
        $karyawan = \DB::table('karyawan')->select('nik')->get();
        foreach ($karyawan as $k) {
            $data[] = ['nik' => $k->nik, 'periode' => $periode];
        }
        \DB::table('gaji')->insert($data);
        return redirect('gaji')->with('message', 'Periode Gaji ' . $periode . ' Sudah Dibuat');
    }

    function ubahPeriodeGaji(Request $request)
    {
        Session(['periode_gaji' => $request->periode]);
        return redirect('gaji')->with('message', ' Periode Gaji di Filter menjadi : ' . $request->periode);
    }
}
