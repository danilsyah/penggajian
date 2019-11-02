<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KalenderKerja;

class KalenderKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['kalenderkerja'] = KalenderKerja::all();
        return view('kalenderkerja.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kalenderkerja.create');
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
            'tanggal' => 'required|unique:kalender_kerja',
            'keterangan' => 'required',
        ]);

        $kalenderkerja = new KalenderKerja();
        $kalenderkerja->tanggal = $request->tanggal;
        $kalenderkerja->keterangan = $request->keterangan;
        $kalenderkerja->save();
        return redirect('kalenderkerja')->with('message', 'Penambahan Data Kalender Kerja Berhasil Pada Tanggal : ' . $request->tanggal);
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
    public function edit($id)
    {
        $data['kalenderkerja'] = KalenderKerja::find($id);
        return view('kalenderkerja.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required',
        ]);

        $kalenderkerja = KalenderKerja::Find($id);
        $kalenderkerja->keterangan = $request->keterangan;
        $kalenderkerja->update();
        return redirect('kalenderkerja')->with('message', 'Edit Data Kalender Kerja Berhasil Pada Tanggal : ' . $request->tanggal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kalenderkerja = KalenderKerja::Find($id);
        $kalenderkerja->delete();
        return redirect('kalenderkerja')->with('message', 'Hapus Data Kalender Kerja Berhasil Pada Tanggal : ' . $kalenderkerja->tanggal);
    }
}
