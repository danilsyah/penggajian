<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gaji;
use App\KomponenGaji;
use Fpdf;
use App\Kehadiran;

class GajiController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $userNik = \Auth::user()->nik;
        $periodeGaji = Session('periode_gaji');
        if ($periodeGaji == '') {
            $periode = date('Y-m');
        } else {
            $periode = $periodeGaji;
        }
        $data['periodeGaji'] = Gaji::pluck('periode', 'periode');
        if (\Auth::user()->is_admin == 1) {
            $data['riwayatGaji'] = Gaji::join('karyawan', 'gaji.nik', '=', 'karyawan.nik')
                ->where('gaji.periode', $periode)
                ->get();
        } else {
            $data['riwayatGaji'] = Gaji::join('karyawan', 'gaji.nik', '=', 'karyawan.nik')
                ->where('gaji.periode', $periode)
                ->where('gaji.nik', $userNik)
                ->get();
        }

        return view('gaji.index', $data);
    }

    function store(Request $request)
    {
        // dd($request->periode);
        $request->validate([
            'periode' => 'required'
        ]);

        $periode = $request->periode;
        $data = [];
        $karyawan = \DB::table('karyawan')->select('nik')->get();
        foreach ($karyawan as $k) {
            $data[] = ['nik' => $k->nik, 'periode' => $periode];
        }
        \DB::table('gaji')->insert($data);
        return redirect('gaji')->with('message', 'Periode Gaji ' . $periode . ' Sudah Dibuat');
    }

    function ubahPeriodeGaji(Request $request)
    {
        Session(['periode_gaji' => $request->periode]);
        return redirect('gaji')->with('message', ' Periode Gaji di Filter menjadi : ' . $request->periode);
    }

    function show($id)
    {
        $gaji = Gaji::find($id);
        $data['gaji'] = $gaji;
        // $periode = substr($gaji->periode, 0, 4) . '-' . substr($gaji->periode, 4, 2);
        $periode = $gaji->periode;
        // dd($periode);
        $data['komponenGaji'] = KomponenGaji::pluck('nama_komponen', 'kode_komponen');

        $data['karyawan'] = \DB::table('karyawan')
            ->join('jabatan', 'karyawan.kode_jabatan', '=', 'jabatan.kode_jabatan')
            ->where('karyawan.nik', $gaji->nik)
            ->first();

        $data['gajiDetail'] = \DB::table('gaji_detail')
            ->join('komponen_gaji', 'komponen_gaji.kode_komponen', '=', 'gaji_detail.kode_komponen')
            ->where('gaji_detail.gaji_id', $id)
            ->get();

        $data['upahLembur']   = \DB::select("select sum(upah) as upah from lembur
                                where periode = '" . $periode . "'
                                and nik = '" . $gaji->nik . "' ");

        $data['periode'] = $periode;
        return view('gaji.show', $data);
    }

    function tambahKomponenGajiDetail(Request $request)
    {
        $data = ['kode_komponen' => $request->kode_komponen, 'gaji_id' => $request->gaji_id];
        \DB::table('gaji_detail')->insert($data);
        return redirect('gaji/' . $request->gaji_id)->with('message', 'Komponen Gaji Berhasil Di Tambah');
    }

    function updateTotalGaji(Request $request, $id)
    {
        $gaji = Gaji::find($id);
        $gaji->total_gaji = $request->totalGaji;
        $gaji->update();
        return redirect('gaji/' . $id);
    }

    function hapusKomponenGajiDetail($id)
    {
        $gaji = \DB::table('gaji_detail')->where('id', $id)->first();
        \DB::table('gaji_detail')->where('id', $id)->delete();
        return redirect('gaji/' . $gaji->gaji_id)->with('message', 'Komponen Gaji Berhasil Di Hapus');
    }

    function slipGajiPdf2($id)
    {
        // ========= Query Database Untuk Mendapatkan Data Gaji =======================
        zonaWaktu();
        $gaji                   = Gaji::find($id);
        $karyawan               = \DB::table('karyawan')
            ->join('jabatan', 'karyawan.kode_jabatan', '=', 'jabatan.kode_jabatan')
            ->join('departemen', 'karyawan.kode_departemen', '=', 'departemen.kode_departemen')
            ->where('karyawan.nik', $gaji->nik)
            ->first();
        $pengaturan             = \DB::table('pengaturan')->where('id', 1)->first();;
        $periode_tahun = substr($gaji->periode, 0, 4);
        $periode_bulan = substr($gaji->periode, 5, 2);
        $periode_sekarang = bulan(substr($gaji->periode, 5, 2)) . ' / ' . substr($gaji->periode, 0, 4);
        // $periode_bln_depan = '01/' . date('m-Y', strtotime('+1 month', strtotime('2019-04')));
        Fpdf::AddPage('L', 'A5');
        Fpdf::SetFont('Arial', 'B', 14);
        Fpdf::Image('uploads/' . $pengaturan->logo, 12, 8, 25, 15);
        Fpdf::Cell(190, 12, 'SLIP GAJI KARYAWAN', 0, 0, 'C');
        Fpdf::line(12, 25, 210 - 20, 25);
        // Fpdf::Cell(190, 16, '', 1, 1, 'C');
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::text(12, 29, 'Nama Perusahaan');
        Fpdf::text(38, 29, ' : ' . $pengaturan->nama_perusahaan);
        Fpdf::text(12, 33, 'Periode');
        Fpdf::text(38, 33, ' : ' . $periode_sekarang);
        Fpdf::text(12, 37, 'Departemen');
        Fpdf::text(38, 37, ' : ' . $karyawan->nama_departemen);
        Fpdf::text(110, 29, 'NIK');
        Fpdf::text(136, 29, ' : ' . $karyawan->nik);
        Fpdf::text(110, 33, 'Nama Karyawan');
        Fpdf::text(136, 33, ' : ' . $karyawan->nama);
        Fpdf::text(110, 37, 'Jabatan');
        Fpdf::text(136, 37, ' : ' . $karyawan->nama_jabatan);
        // Fpdf::Cell(190, 90, '', 1, 1, 'C');
        // ---------------------------------------
        Fpdf::text(12, 44, 'Penerimaan ( +)');
        Fpdf::line(12, 79, 210 - 20, 79);
        Fpdf::line(12, 46, 110 - 20, 46);
        Fpdf::line(110, 46, 210 - 20, 46);
        // KALKULASI KOMPONEN GAJI -------------------------
        $total_penerimaan = 0;
        $total_potongan = 0;
        $jml_kehadiran = hitungJmlKehadiran($karyawan->nik, $periode_tahun . '-' . $periode_bulan);
        // gaji pokok harian
        // $gph = $karyawan->gaji_pokok / 20;
        $gp = $karyawan->gaji_pokok;
        // gaji berdasarkan kehadiran
        // $gbh = $gph * $jml_kehadiran;
        $total_penerimaan = $total_penerimaan + $gp;
        $penerimaan = [
            [
                'kode_komponen' => 'GP',
                'nama_komponen' => 'Gaji Pokok',
                'nilai' => $karyawan->gaji_pokok
            ],
            [
                'kode_komponen' => 'TJB',
                'nama_komponen' => 'Tunjangan Jabatan',
                'nilai' => $karyawan->tunjangan_jabatan
            ]
            // ,
            // [
            //     'kode_komponen' => 'GPH',
            //     'nama_komponen' => 'Gaji Pokok Harian',
            //     'nilai' => $gph
            // ],
            // [
            //     'kode_komponen' => 'GBH',
            //     'nama_komponen' => 'Gaji Berdasarkan Kehadiran (' . $jml_kehadiran . ')',
            //     'nilai' => $gbh
            // ]
        ];
        $potongan = [];
        // =============== KOMPONEN GAJI DETAIL ======================
        $gaji_detail =  \DB::table('gaji_detail')
            ->join('komponen_gaji', 'komponen_gaji.kode_komponen', '=', 'gaji_detail.kode_komponen')
            ->where('gaji_detail.gaji_id', $id)
            ->get()->toArray();

        foreach ($gaji_detail as $gd) {
            $komponen_baru = ['kode_komponen' => $gd->kode_komponen, 'nama_komponen' => $gd->nama_komponen, 'nilai' => $gd->nilai];

            if ($gd->jenis == 'tunjangan') {
                array_push($penerimaan, $komponen_baru);
            } else {
                array_push($potongan, $komponen_baru);
            }
        }
        // ============== HITUNG LEMBUR ==============================================
        $hitungLembur = \DB::select("select sum(upah) as upah
                             from lembur where left(tanggal_masuk,7)='" . $periode_tahun . '-' . $periode_bulan . "'
                             and nik='" . $gaji->nik . "'");
        $upahLembur   = $hitungLembur[0]->upah;
        $lembur = ['kode_komponen' => 'LBR', 'nama_komponen' => 'Upah Lembur', 'nilai' => $upahLembur];
        array_push($penerimaan, $lembur);
        $start = 52;
        foreach ($penerimaan as $p) {
            Fpdf::text(12, $start, $p['kode_komponen']);
            Fpdf::text(24, $start, $p['nama_komponen']);
            Fpdf::text(74, $start, ': ' . rupiah($p['nilai']));

            if ($p['kode_komponen'] != 'GPH' and $p['kode_komponen'] != 'GP' and $p['kode_komponen'] != 'GBH') {
                $total_penerimaan += $p['nilai'];
            }

            $start = $start + 5;
        }
        //////////////////////////////////////////////////////////////////////
        Fpdf::text(110, 44, 'Potongan ( -)');
        $start = 52;
        foreach ($potongan as $pt) {
            //dd($pt);
            Fpdf::text(110, $start, $pt['kode_komponen']);
            Fpdf::text(124, $start, $pt['nama_komponen']);
            Fpdf::text(174, $start, ': ' . rupiah($pt['nilai']));
            $start = $start + 5;
            $total_potongan = $total_potongan + $pt['nilai'];
        }
        Fpdf::text(12, 86, 'Total');
        Fpdf::text(74, 86, ': ' . rupiah($total_penerimaan));
        Fpdf::text(12, 90, 'Diterima');
        Fpdf::text(74, 90, ': ' . (rupiah($total_penerimaan - $total_potongan)));
        Fpdf::text(12, 94, '---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
        Fpdf::text(120, 100, 'Diserahkan Oleh');
        Fpdf::text(125, 120, 'Admin');
        Fpdf::text(12, 124, 'Tgl Cetak : ' . date('d/m/Y : H:i:s'));
        Fpdf::text(160, 100, 'Diterima Oleh');
        Fpdf::text(163, 120, $karyawan->nama);
        Fpdf::Output();
        exit;
    }

    // function slipGajiPdf($id)
    // {
    //     date_default_timezone_set("Asia/Jakarta");
    //     $data['pengaturan']     = \DB::table('pengaturan')->where('id', 1)->first();

    //     $data['komponenGaji']   = KomponenGaji::pluck('nama_komponen', 'kode_komponen');
    //     $gaji                   = Gaji::find($id);

    //     $periode                = substr($gaji->periode, 0, 4) . '-' . substr($gaji->periode, 4, 2);
    //     $data['gaji']           = $gaji;

    //     $data['karyawan']       = \DB::table('karyawan')
    //         ->join('jabatan', 'karyawan.kode_jabatan', '=', 'jabatan.kode_jabatan')
    //         ->where('karyawan.nik', $gaji->nik)
    //         ->first();

    //     $data['gajiDetail']     = \DB::table('gaji_detail')
    //         ->join('komponen_gaji', 'komponen_gaji.kode_komponen', '=', 'gaji_detail.kode_komponen')
    //         ->where('gaji_detail.gaji_id', $id)
    //         ->get();

    //     $data['hitungLembur']   = $data['upahLembur']   = \DB::select("select sum(upah) as upah from lembur
    //                             where left(tanggal_masuk,7) = '" . $periode . "'
    //                             and nik = '" . $gaji->nik . "' ");
    //     $data['periode']        = $periode;
    //     $pdf = \PDF::loadView('gaji.slipgaji', $data);
    //     return $pdf->stream('slip_gaji.pdf');
    // }

    function laporanGaji(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        if ($bulan < 10) {
            $periode = $tahun . '-0' . $bulan;
        } else {
            $periode = $tahun . '-' . $bulan;
        }

        // dd(bulan($bulan));
        $data['periode'] = bulan($bulan) . ' - ' . $tahun;
        $data['pengaturan'] = \DB::table('pengaturan')->where('id', 1)->first();
        // $data['gaji'] = \DB::table('gaji')
        //     ->join('karyawan', 'gaji.nik', '=', 'karyawan.nik')
        //     ->join('jabatan', 'jabatan.kode_jabatan', '=', 'karyawan.kode_jabatan')
        //     ->join('departemen', 'departemen.kode_departemen', '=', 'karyawan.kode_departemen')
        //     ->where('gaji.periode', '=', $periode)
        //     ->orderBy('karyawan.nama')
        //     ->get();

        $data['gaji'] = \DB::select("
            select k.nik ,k.nama ,j.nama_jabatan , d.nama_departemen , g.total_gaji, g.periode
            from gaji as g
            join karyawan as k on g.nik = k.nik
            join departemen as d on k.kode_departemen = d.kode_departemen
            join jabatan as j on k.kode_jabatan = j.kode_jabatan
            where g.periode = '" . $periode . "'");

        // dd($data['gaji']);

        // $data['totalGaji'] = \DB::select("select sum(total_gaji) as totalgaji from gaji
        // where periode  = '" . $periode . "'");
        $data['totalGaji'] = \DB::table('gaji')->where('periode', $periode)->sum('total_gaji');
        $pdf = \PDF::loadView('gaji.laporan_gaji', $data);
        return $pdf->stream('laporan_gaji_' . $tahun . '_' . $bulan);
    }
}
