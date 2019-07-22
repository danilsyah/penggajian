<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Jabatan;
use App\Departemen;
use App\StatusKawin;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['karyawan'] = Karyawan::join('departemen', 'departemen.kode_departemen', '=', 'karyawan.kode_departemen')
            ->join('jabatan', 'jabatan.kode_jabatan', '=', 'karyawan.kode_jabatan')
            ->join('status_kawin', 'status_kawin.kode_status_kawin', '=', 'karyawan.kode_status_kawin')
            ->get();
        return view('karyawan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jabatan'] = Jabatan::pluck('nama_jabatan', 'kode_jabatan');
        $data['departemen'] = Departemen::pluck('nama_departemen', 'kode_departemen');
        $data['status_kawin'] = StatusKawin::pluck('keterangan', 'kode_status_kawin');
        return view('karyawan.create', $data);
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
            'nik' => 'required|unique:karyawan|min:6|max:6',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'jenis_kelamin' => 'required|not_in:0',
        ]);

        if ($request->hasFile('foto')) {
            //upload foto
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $fileName);
        } else {
            $fileName = null;
        }

        $karyawan = new Karyawan();
        $karyawan->nik              = $request->nik;
        $karyawan->nama             = $request->nama;
        $karyawan->tanggal_lahir    = $request->tanggal_lahir;
        $karyawan->alamat           = $request->alamat;
        $karyawan->tanggal_masuk    = $request->tanggal_masuk;
        $karyawan->kode_status_kawin = $request->kode_status_kawin;
        $karyawan->jenis_kelamin    = $request->jenis_kelamin;
        $karyawan->foto             = $fileName;
        $karyawan->kode_departemen  = $request->kode_departemen;
        $karyawan->kode_jabatan     = $request->kode_jabatan;
        $karyawan->save();
        return redirect('karyawan')->with('message', 'Berhasil Menambah Data Karyawan Dengan NIK :' . $request->nik);
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
    public function edit($nik)
    {
        $data['karyawan'] = Karyawan::find($nik);
        $data['jabatan'] = Jabatan::pluck('nama_jabatan', 'kode_jabatan');
        $data['departemen'] = Departemen::pluck('nama_departemen', 'kode_departemen');
        $data['status_kawin'] = StatusKawin::pluck('keterangan', 'kode_status_kawin');
        return view('karyawan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'jenis_kelamin' => 'required|not_in:0',
        ]);



        $karyawan = Karyawan::find($nik);
        $karyawan->nama             = $request->nama;
        $karyawan->tanggal_lahir    = $request->tanggal_lahir;
        $karyawan->alamat           = $request->alamat;
        $karyawan->tanggal_masuk    = $request->tanggal_masuk;
        $karyawan->kode_status_kawin = $request->kode_status_kawin;
        $karyawan->jenis_kelamin    = $request->jenis_kelamin;
        if ($request->hasFile('foto')) {
            //upload foto
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $fileName);
            $karyawan->foto = $fileName;
        }
        $karyawan->kode_departemen  = $request->kode_departemen;
        $karyawan->kode_jabatan     = $request->kode_jabatan;
        $karyawan->update();
        return redirect('karyawan')->with('message', 'Berhasil Edit Data Karyawan Dengan NIK :' . $request->nik);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        $karyawan = karyawan::find($nik);
        $karyawan->delete();
        return redirect('karyawan')->with('message', 'Karyawan Dengan NIK : ' . $nik);
    }
}
