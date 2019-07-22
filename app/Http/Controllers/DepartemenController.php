<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['departemen'] = Departemen::all();
        return view('departemen.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $awal = 'DP';
        $noUrutAkhir = Departemen::max('kode_departemen');
        $noUrut = (int)substr($noUrutAkhir, 6, 6);
        $noUrut++;
        $kodeDepartemen['kodeOtomatisDepartemen'] = $awal . sprintf("%06s", $noUrut);
        return view('departemen.create', $kodeDepartemen);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_departemen' => 'required|unique:departemen|max:8|min:8',
            'nama_departemen' => 'required',
        ]);
        $departemen = new Departemen();
        $departemen->kode_departemen = $request->kode_departemen;
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->save();
        return redirect('departemen')->with('message', 'Penambahan Data Berhasil Dengan Kode : ' . $request->kode_departemen);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_departemen)
    {
        $data['departemen'] = Departemen::find($kode_departemen);
        return view('departemen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_departemen)
    {
        $request->validate([
            'nama_departemen' => 'required',
        ]);
        $departemen = Departemen::find($kode_departemen);
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->update();
        return redirect('departemen')->with('message', 'Update Data Berhasil Dengan Kode : ' . $kode_departemen);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_departemen)
    {
        $departemen = Departemen::find($kode_departemen);
        $departemen->delete();
        return redirect('departemen')->with('message', 'Data Berhasil Di Hapus Dengan Kode : ' . $kode_departemen);
    }
}
