<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    function index()
    {
        $data['pengaturan'] = \DB::table('pengaturan')->where('id', 1)->first();
        return view('pengaturan', $data);
    }

    function save(request $request)
    {

        if ($request->hasFile('logo')) {
            // Upload logo
            $file = $request->file('logo');

            // Mengganti nama file dengan timestamp dan ekstensi asli
            // $fileName = time() . '.' . $file->getClientOriginalExtension();
            $fileName = 'logo.' . $file->getClientOriginalExtension();

            $destinationPath = 'uploads';
            $file->move($destinationPath, $fileName);

            // Menyimpan data termasuk logo
            $data = [
                'nama_perusahaan'   => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'email'             => $request->email,
                'no_telepon'        => $request->no_telepon,
                'logo'              => $fileName
            ];
        } else {
            // Tidak upload logo
            $data = [
                'nama_perusahaan'   => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'email'             => $request->email,
                'no_telepon'        => $request->no_telepon,
            ];
        }

        \DB::table('pengaturan')->where('id', 1)->update($data);
        return redirect('pengaturan')->with('message', 'Berhasil Edit Profil Instansi..!!');
    }
}
