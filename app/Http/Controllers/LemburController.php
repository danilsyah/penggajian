<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Karyawan;
use App\Gaji;
use Redirect;

class LemburController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        if (session('periodeLembur')) {
            $periode = session('periodeLembur');
            $data['riwayatLembur'] = \DB::table('lembur')
                ->select('lembur.*', 'karyawan.nama', 'kalender_kerja.keterangan')
                ->join('karyawan', 'karyawan.nik', '=', 'lembur.nik')
                ->leftJoin('kalender_kerja', 'kalender_kerja.id', '=', 'lembur.kalender_kerja_id')
                ->whereRaw("date(lembur.tanggal_masuk) = '$periode'")
                ->get();
        } else {
            // $periode = date("Y-m-d");
            $data['riwayatLembur'] = \DB::table('lembur')
                ->select('lembur.*', 'karyawan.nama', 'kalender_kerja.keterangan')
                ->join('karyawan', 'karyawan.nik', '=', 'lembur.nik')
                ->leftJoin('kalender_kerja', 'kalender_kerja.id', '=', 'lembur.kalender_kerja_id')
                ->get();
        }

        return view('lembur.index', $data);
    }

    function create()
    {
        $data['karyawan'] = Karyawan::pluck('nama', 'nik');
        $data['periodeGaji'] = Gaji::pluck('periode', 'periode');
        return view('lembur.create', $data);
    }

    function store(Request $request)
    {
        $request->validate([
            'nik'           => 'required',
            'tanggal_masuk'  => 'required',
            'tanggal_pulang' => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            'periode'       => 'required',
            // 'durasi_lembur'  => 'required',
        ]);

        $karyawan = \DB::table('karyawan')->where('nik', $request->nik)->first();
        $kalenderKerja = \DB::table('kalender_kerja')->where('tanggal', $request->tanggal_masuk)->first();
        $jamLemburMulai = Carbon::parse($request->tanggal_masuk . ' ' . $request->jam_masuk);
        $jamLemburAkhir = Carbon::parse($request->tanggal_pulang . ' ' . $request->jam_pulang);
        $durasiJam = $jamLemburMulai->diffInHours($jamLemburAkhir);
        $durasiMenit = $jamLemburMulai->diff($jamLemburAkhir)->format('%I');
        $durasiLembur = $durasiJam . ':' . $durasiMenit;
        $upahPerJam = $karyawan->gaji_pokok / 173; //rumus upah per jam
        // perhitungan pembulatan menit 
        if ($durasiMenit >= 45) {
            $pembulantanDurasiLembur = $durasiJam + 1;
        } else if ($durasiMenit >= 30 && $durasiMenit <= 44) {
            $pembulantanDurasiLembur = $durasiJam . '.' . '5';
        } else {
            $pembulantanDurasiLembur = $durasiJam;
        }
        if ($karyawan != null) {
            if ($kalenderKerja != null) {
                $keteranganKalenderKerja = $kalenderKerja->id;
            } else {
                $keteranganKalenderKerja = 0;
            }


            if ($pembulantanDurasiLembur <= 1 && $keteranganKalenderKerja == 0) {  //kondisi upah lembur kurang dari 1 jam dan lembur di hari kerja normal
                $upahLembur = 1.5 * $upahPerJam;
            } else if ($pembulantanDurasiLembur > 1 && $keteranganKalenderKerja == 0) {  // kondisi upah lembur lebih dari 1 jam dan lembur di hari kerja normal
                $upahLembur = (2 * $upahPerJam) * $pembulantanDurasiLembur;
            } else if ($pembulantanDurasiLembur > 14 && $keteranganKalenderKerja != 0) { // kondisi upah lembur lebih dari 14 jam dan lembur di hari libur
                $upahLembur = (4 * $upahPerJam) * $pembulantanDurasiLembur;
            } else if ($pembulantanDurasiLembur > 7 && $keteranganKalenderKerja != 0) { // kondisi upah lembur lebih dari 7 jam dan lembur di hari libur
                $upahLembur = (3 * $upahPerJam) * $pembulantanDurasiLembur;
            } else { // kondisi durasi lembur kurang dari 7 jam di hari libur dan hari besar
                $upahLembur  = (2 * $upahPerJam) * $pembulantanDurasiLembur;
            }

            $data = [
                'nik'                   => $karyawan->nik,
                'tanggal_masuk'         => $request->tanggal_masuk . ' ' . $request->jam_masuk,
                'tanggal_pulang'        => $request->tanggal_pulang . ' ' . $request->jam_pulang,
                'durasi_lembur'         => $durasiLembur,
                'kalender_kerja_id'     => $keteranganKalenderKerja,
                'upah'                  => (int) $upahLembur, // casting / merubah variable menjadi tipe data int
                'periode'               => $request->periode
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
