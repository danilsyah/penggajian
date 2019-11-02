<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusKawin;

class StatusKawinController extends Controller
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
        $data['statuskawin'] = StatusKawin::all();
        return view('statuskawin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuskawin.create');
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
            'kode_status_kawin' => 'required|unique:status_kawin|max:3|min:1',
            'keterangan' => 'required',
        ]);
        $statusKawin = new StatusKawin();
        $statusKawin->kode_status_kawin = $request->kode_status_kawin;
        $statusKawin->keterangan = $request->keterangan;
        $statusKawin->save();
        return redirect('statuskawin')->with('message', 'Penambahan Data Status Kawin Berhasil Dengan Kode : ' . $request->kode_status_kawin);
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
    public function edit($kode_status_kawin)
    {
        $data['StatusKawin'] = StatusKawin::find($kode_status_kawin);
        return view('statuskawin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_status_kawin)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);
        $StatusKawin = StatusKawin::find($kode_status_kawin);
        $StatusKawin->keterangan = $request->keterangan;
        $StatusKawin->update();
        return redirect('statuskawin')->with('message', 'Update Data Berhasil Dengan Kode : ' . $request->kode_status_kawin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_status_kawin)
    {
        $StatusKawin = StatusKawin::find($kode_status_kawin);
        $StatusKawin->delete();
        return redirect('statuskawin')->with('message', 'Data Berhasil Di Hapus Dengan Kode : ' . $kode_status_kawin);
    }
}
