<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomponenGaji;

class KomponenGajiController extends Controller
{
    function index()
    {
        $data['komponenGaji'] = KomponenGaji::all();
        return view('komponenGaji.index', $data);
    }

    function create()
    {
        $awal = 'KP';
        $noUrutAkhir = KomponenGaji::max('kode_komponen');
        $noUrut = (int) substr($noUrutAkhir, 2, 2);
        $noUrut++;
        $kodeOtomatisKomponen['kodeOtomatisKomponen'] = $awal . sprintf("%02s", $noUrut);
        return view('komponenGaji.create', $kodeOtomatisKomponen);
    }

    function store(Request $request)
    {
        $request->validate([
            'nama_komponen' => 'required',
            'jenis'         => 'required|not_in:0',
            'nilai'         => 'required',
        ]);

        $komponenGaji = new KomponenGaji();
        $komponenGaji->kode_komponen = $request->kode_komponen;
        $komponenGaji->nama_komponen = $request->nama_komponen;
        $komponenGaji->jenis = $request->jenis;
        $komponenGaji->nilai = $request->nilai;
        $komponenGaji->save();
        return redirect('komponenGaji')->with('message', 'Data Komponen Gaji Berhasil di Tambahkan');
    }

    function edit($kode_komponen)
    {
        $data['komponenGaji'] = KomponenGaji::find($kode_komponen);
        //dd($data);
        return view('komponenGaji.edit', $data);
    }

    function update(Request $request, $kode_komponen)
    {
        $request->validate([
            'nama_komponen' => 'required',
            'jenis'         => 'required|not_in:0',
            'nilai'         => 'required',
        ]);
        $komponenGaji = KomponenGaji::find($kode_komponen);
        $komponenGaji->nama_komponen = $request->nama_komponen;
        $komponenGaji->jenis = $request->jenis;
        $komponenGaji->nilai = $request->nilai;
        $komponenGaji->update();
        return redirect('komponenGaji')->with('message', 'Data Komponen Gaji Berhasil di Edit');
    }

    function destroy($kode_komponen)
    {
        $komponenGaji = KomponenGaji::find($kode_komponen);
        $komponenGaji->delete();
        return redirect('komponenGaji')->with('message', 'Data Berhasil Di Hapus Dengan Kode : ' . $kode_komponen);
    }
}
