<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $tgl = date('m');
        $tahun = date('Y');
        $data['totalLembur'] = \DB::table('lembur')->select(\DB::raw('count(distinct nik) as total'))
            ->where(\DB::raw('left(tanggal_masuk,7)'), $tahun . '-' . $tgl)
            ->get();
        $data['jmlKaryawan'] = \DB::table('karyawan')->count();
        $data['jmlKehadiran'] = \DB::table('kehadiran')->select(\DB::raw('count(distinct nik) as jml_kehadiran'))
            ->where(\DB::raw('left(tanggal_masuk,7)'), $tahun . '-' . $tgl)
            ->get();
        return view('dashboard', $data);
    }
}
