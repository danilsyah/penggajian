<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data['jabatan'] = Jabatan::all();
        return view('jabatan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $awal = 'JB';
        $noUrutAkhir = Jabatan::max('kode_jabatan');
        $noUrut = (int) substr($noUrutAkhir,3,3);
        $noUrut++;
        $kodeOtomatisJabatan['kodeOtomatisJabatan'] = $awal.sprintf("%03s",$noUrut);
        return view('jabatan.create',$kodeOtomatisJabatan);
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
            'kode_jabatan' =>'required|unique:jabatan|max:5|min:5',
            'nama_jabatan' =>'required|min:5',
            'tunjangan_jabatan' =>'required',
        ]);
        $jabatan = new Jabatan();
        $jabatan->kode_jabatan = $request->kode_jabatan;
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->tunjangan_jabatan = $request->tunjangan_jabatan;
        $jabatan->save();
        return redirect('jabatan')->with('message','Penambahan Data Berhasil Dengan Kode : '.$request->kode_jabatan);
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
    public function edit($kode_jabatan)
    {
        $data['jabatan'] = Jabatan::find($kode_jabatan);
        //dd($data);
        return view('jabatan.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_jabatan)
    {
        $request->validate([
            'nama_jabatan' =>'required|min:5',
            'tunjangan_jabatan' => 'required',
        ]);
        $jabatan = Jabatan::find($kode_jabatan);
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->tunjangan_jabatan = $request->tunjangan_jabatan;
        $jabatan->update();
        return redirect('jabatan')->with('message','Update Data Berhasil Dengan Kode : '.$kode_jabatan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_jabatan)
    {
        $jabatan = Jabatan::find($kode_jabatan);
        $jabatan->delete();
        return redirect('jabatan')->with('message','Data Berhasil Di Hapus Dengan Kode : '.$kode_jabatan);
    }
}
