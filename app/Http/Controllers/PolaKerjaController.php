<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PolaKerja;

class PolaKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['polaKerja'] = PolaKerja::all();
        return view('polakerja.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polakerja.create');
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
            'pola_kerja' => 'required|unique:pola_kerja',
        ]);
        $polaKerja = new PolaKerja();
        $polaKerja->pola_kerja = $request->pola_kerja;
        $polaKerja->save();
        return redirect('polakerja')->with('message', 'Penambahan Data Berhasil :' . $request->pola_kerja);
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
        $data['polaKerja'] = PolaKerja::find($id);
        return view('polakerja.edit', $data);
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
            'pola_kerja' => 'required|unique:pola_kerja',
        ]);
        $polaKerja = PolaKerja::find($id);
        $polaKerja->pola_kerja = $request->pola_kerja;
        $polaKerja->update();
        return redirect('polakerja')->with('message', 'Update data berhasil : ' . $request->pola_kerja);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $polaKerja = PolaKerja::find($id);
        $polaKerja->delete();
        return redirect('polakerja')->with('message', 'Data Berhasil Di Hapus : ' . $polaKerja->pola_kerja);
    }
}
