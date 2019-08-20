<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Karyawan;
use Redirect;

class LemburController extends Controller
{
    function index()
    {

        if (session('periodeLembur')) {
            $periode = session('periodeLembur');
            $data['riwayatLembur'] = \DB::table('lembur')
                ->select('lembur.*', 'karyawan.nama')
                ->join('karyawan', 'karyawan.nik', '=', 'lembur.nik')
                ->whereRaw("date(lembur.tanggal_masuk) = '$periode'")
                ->get();
        } else {
            // $periode = date("Y-m-d");
            $data['riwayatLembur'] = \DB::table('lembur')
                ->select('lembur.*', 'karyawan.nama')
                ->join('karyawan', 'karyawan.nik', '=', 'lembur.nik')
                ->get();
        }
        return view('lembur.index', $data);
    }

    function create()
    {
        $data['karyawan'] = Karyawan::select('nik', 'nama')->get();
        return view('lembur.create', $data);
    }

    function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required',
            'tanggal_masuk'  => 'required',
            'tanggal_pulang' => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            // 'durasi_lembur'  => 'required',
        ]);

        $karyawan = \DB::table('karyawan')->where('nama', $request->nama)->first();

        $jamLemburMulai = Carbon::parse($request->tanggal_masuk . ' ' . $request->jam_masuk);
        $jamLemburAkhir = Carbon::parse($request->tanggal_pulang . ' ' . $request->jam_pulang);
        $durasiLembur = $jamLemburMulai->diffInHours($jamLemburAkhir) . ':' . $jamLemburMulai->diff($jamLemburAkhir)->format('%I');
        // $lembur = (gmdate("H:i ", $durasiLembur));
        // dd($durasiLembur);
        if ($karyawan != null) {
            $data = [
                'nik'                   => $karyawan->nik,
                'tanggal_masuk'         => $request->tanggal_masuk . ' ' . $request->jam_masuk,
                'tanggal_pulang'        => $request->tanggal_pulang . ' ' . $request->jam_pulang,
                'durasi_lembur'         => $durasiLembur
            ];
            \DB::table('lembur')->insert($data);
            return Redirect('/lembur')->with('message', 'Data Lembur Dengan Nama ' . $request->nama . ' Berhasil Di Simpan');
        } else {
            return Redirect::back()->with('message', 'Karyawan Dengan Nama ' . $request->nama . ' Tidak Ditemukan');
        }
    }

    public function ubahPeriodeLembur(Request $request)
    {
        session(['periodeLembur' => $request->periodeLembur]);
        return redirect('lembur')->with('message', 'Periode Kehadiran Sudah Di Filter Tanggal ' . $request->periodeLembur);
    }

    function destroy($id, $url)
    {
        $lembur =  \DB::table('lembur')->where('id', $id)->first();
        \DB::table('lembur')->where('id', $id)->delete();

        if ($url == 'lembur') {
            return redirect('lembur/')->with('message', 'Data Riwayat Lembur dengan NIK = ' . $lembur->nik . ' Berhasil di Hapus');
        } else {
            return redirect('karyawan/' . $lembur->nik . '/lembur')->with('message', 'Data Riwayat Lembur dengan Tanggal = ' . $lembur->tanggal_masuk . ' Berhasil di Hapus');
        }
    }
}
