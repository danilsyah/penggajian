<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kehadiran;
use App\Karyawan;
use App\StatusKehadiran;
use Redirect;
use App\Exports\KehadiranExport;
use App\Imports\KehadiranImport;
use Maatwebsite\Excel\Facades\Excel;

class KehadiranController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (session('periodeKehadiran')) {
            $data['kehadiran'] = Karyawan::select('karyawan.nik', 'karyawan.nama', 'departemen.nama_departemen', 'kehadiran.id', 'kehadiran.tanggal_masuk', 'kehadiran.tanggal_pulang', 'status_kehadiran.status_kehadiran')
                ->leftJoin('kehadiran', function ($join) {
                    $periode = session('periodeKehadiran');
                    $join->on('kehadiran.nik', '=', 'karyawan.nik')
                        ->whereRaw("date(kehadiran.tanggal_masuk)='$periode'");
                })
                ->leftJoin('status_kehadiran', 'kehadiran.kode_status_kehadiran', '=', 'status_kehadiran.kode_status_kehadiran')
                ->join('departemen', 'karyawan.kode_departemen', '=', 'departemen.kode_departemen')
                ->get();
        } else {
            $data['kehadiran'] = Karyawan::select('karyawan.nik', 'karyawan.nama', 'departemen.nama_departemen', 'kehadiran.id', 'kehadiran.tanggal_masuk', 'kehadiran.tanggal_pulang', 'status_kehadiran.status_kehadiran')
                ->leftJoin('kehadiran', 'kehadiran.nik', '=', 'karyawan.nik')
                ->leftJoin('status_kehadiran', 'kehadiran.kode_status_kehadiran', '=', 'status_kehadiran.kode_status_kehadiran')
                ->join('departemen', 'karyawan.kode_departemen', '=', 'departemen.kode_departemen')
                ->orderby('tanggal_masuk', 'asc')
                ->get();
        }
        return view('kehadiran.index', $data);
        // return date(now());
    }

    public function create()
    {
        //    parsing data karyawan dari database
        $data['karyawan'] = Karyawan::pluck('nama', 'nik');
        $data['statusKehadiran'] = StatusKehadiran::pluck('status_kehadiran', 'kode_status_kehadiran');
        return view('kehadiran.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'           => 'required',
            'tanggal_masuk'  => 'required',
            'tanggal_pulang' => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'           => 'required',
        ]);

        $karyawan = \DB::table('karyawan')->where('nik', $request->nik)->first();

        if ($request->nik != null) {
            $data = [
                'nik' => $request->nik,
                'tanggal_masuk' => $request->tanggal_masuk . ' ' . $request->jam_masuk,
                'tanggal_pulang' => $request->tanggal_pulang . ' ' . $request->jam_pulang,
                'kode_status_kehadiran' => $request->kode_status_kehadiran
            ];
            \DB::table('kehadiran')->insert($data);
            return Redirect('/kehadiran')->with('message', 'Data Kehadiran Dengan Nama ' . $karyawan->nama . ' Berhasil Di Simpan');
        } else {
            return Redirect::back()->with('message', 'Karyawan Dengan Nama ' . $karyawan->nama . ' Tidak Ditemukan');
        }
    }

    function destroy($id)
    {
        $kehadiran = Kehadiran::find($id);
        $kehadiran->delete();
        return redirect('kehadiran')->with('message', 'Data Berhasil Di Hapus Dengan ID : ' . $id);
    }

    public function ubahPeriodeKehadiran(Request $request)
    {
        session(['periodeKehadiran' => $request->periodeKehadiran]);
        return redirect('kehadiran')->with('message', 'Periode Kehadiran Sudah Di Filter Tanggal ' . $request->periodeKehadiran);
    }

    function exportExcel(Request $request)
    {
        $awal = $request->tanggal_mulai;
        $akhir = $request->tanggal_selesai;
        return Excel::download(new KehadiranExport($awal, $akhir), 'laporan_kehadiran.xlsx');
    }

    function importExcel(Request $request)
    {
        $file       = $request->file('file');
        $fileName   = $file->getClientOriginalName();
        $destionationPath = 'uploads';
        $file->move($destionationPath, $fileName);

        Excel::import(new KehadiranImport, public_path() . '/uploads/' . $fileName);
        return redirect('kehadiran')->with('message', 'Laporan Absensi Berhasil di Import ke Sistem');
    }

    public function hitungJmlKehadiran($nik, $periode)
    {
        $jumlahKehadiran = \DB::select("SELECT COUNT(nik) as jml from kehadiran where left(tanggal_masuk,7) = '" . $periode . "' and nik = '" . $nik . "' ");
        return $jumlahKehadiran;
    }
}
