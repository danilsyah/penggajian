<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokKerja;
use Illuminate\Support\Facades\Redirect;
use App\PolaKerja;
use PhpParser\Node\Stmt\Foreach_;

class kelompokKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kelompokKerja'] = KelompokKerja::all();
        return view('kelompokkerja.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelompokkerja.create');
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
            'kelompok_kerja' => 'required|unique:kelompok_kerja',
        ]);
        $kelompokKerja = new KelompokKerja();
        $kelompokKerja->kelompok_kerja = $request->kelompok_kerja;
        $kelompokKerja->save();
        return redirect('kelompokkerja')->with('message', 'Penambahan Data Berhasil : ' . $request->kelompok_kerja);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // pengolahan data anggota kelompok kerja
    public function show($id)
    {
        $data['karyawan'] = \DB::table('karyawan')->get();
        $data['kelompokKerja'] = KelompokKerja::find($id);
        $data['anggota'] = \DB::table('anggota_kelompok_kerja')
            ->join('karyawan', 'karyawan.nik', '=', 'anggota_kelompok_kerja.nik')
            ->where('anggota_kelompok_kerja.kelompok_kerja_id', $id)
            ->get();
        return view('kelompokkerja.anggota', $data);
    }

    public function tambahAnggota(Request $request)
    {

        if ($request->nama == null) {
            return Redirect('kelompokkerja/' . $request->id)->with('message', 'Anda Belum Meng-Input Karyawan ');
        } else {
            $karyawan = \DB::table('karyawan')->where('nama', $request->nama)->first();
            $anggota = \DB::table('anggota_kelompok_kerja')
                ->join('kelompok_kerja', 'kelompok_kerja.id', '=', 'anggota_kelompok_kerja.kelompok_kerja_id')
                ->where('nik', $karyawan->nik)->first();
            // dd($anggota);
            if ($anggota == null || $anggota->nik != $karyawan->nik) {
                $data = ['nik' => $karyawan->nik, 'kelompok_kerja_id' => $request->id];
                \DB::table('anggota_kelompok_kerja')->insert($data);
                return Redirect('kelompokkerja/' . $request->id)->with('message', 'Data Anggota : ' . $request->nama . ' Berhasil Ditambahkan');
            } else if ($anggota->nik == $karyawan->nik) {
                return Redirect('kelompokkerja/' . $request->id)->with('message', 'Data Karyawan : ' . $request->nama . ' Sudah Masuk Anggota Kelompok Kerja : ' . $anggota->kelompok_kerja);
            } else {
                return Redirect('kelompokkerja/' . $request->id)->with('message', 'Data Karyawan : ' . $request->nama . ' Tidak Ditemukan ');
            }
        }

        // return $request->all();
    }

    public function hapusAnggota($id)
    {
        $anggota = \DB::table('anggota_kelompok_kerja')
            ->select()
            ->join('karyawan', 'karyawan.nik', '=', 'anggota_kelompok_kerja.nik')
            ->where('anggota_kelompok_kerja.id', $id)
            ->first();
        // dd($anggota);
        \DB::table('anggota_kelompok_kerja')
            ->where('id', $id)
            ->delete();
        return redirect('kelompokkerja/' . $anggota->kelompok_kerja_id)->with('message', 'Anggota dengan Nama : ' . $anggota->nama . ' Berhasil Dihapus');
    }

    // end pengolahan anggota kelompok kerja

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kelompokKerja'] = KelompokKerja::find($id);
        return view('kelompokkerja.edit', $data);
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
            'kelompok_kerja' => 'required|unique:kelompok_kerja',
        ]);
        $kelompokKerja = KelompokKerja::find($id);
        $kelompokKerja->kelompok_kerja = $request->kelompok_kerja;
        $kelompokKerja->update();
        return redirect('kelompokkerja')->with('message', 'Update data berhasil ' . $request->kelompok_kerja);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompokKerja = KelompokKerja::find($id);
        $kelompokKerja->delete();
        return redirect('kelompokkerja')->with('message', 'Data Berhasil Di Hapus : ' . $kelompokKerja->kelompok_kerja);
    }

    public function showPolaKerja($id)
    {
        $data['kelompokKerja'] = KelompokKerja::find($id);
        $data['polaKerja'] = PolaKerja::pluck('pola_kerja', 'id');
        $data['polaKerjaKelompok'] = \DB::table('pola_kerja_kelompok_karyawan')
            ->select('pola_kerja_kelompok_karyawan.tanggal', 'pola_kerja_kelompok_karyawan.id', 'pola_kerja.pola_kerja', 'pola_kerja.jam_masuk', 'pola_kerja.jam_pulang')
            ->join('pola_kerja', 'pola_kerja.id', '=', 'pola_kerja_kelompok_karyawan.pola_kerja_id')
            ->where('pola_kerja_kelompok_karyawan.kelompok_kerja_id', $id)
            ->orderby('tanggal')
            ->paginate(7);

        return view('kelompokkerja.addpolakerja', $data);
    }

    public function simpanPolaKerja(Request $request)
    {
        // proses simpan data pola kerja kelompok karyawan
        $dataPolaKerja = [];
        $period = new \DatePeriod(
            new \DateTime($request->dari_tanggal),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime('1 day', strtotime($request->sampai_tanggal))))
        );

        foreach ($period as $key => $value) {
            $dataPolaKerja[] = [
                'tanggal'           => $value->format('Y-m-d'),
                'pola_kerja_id'     => $request->pola_kerja,
                'kelompok_kerja_id' => $request->kelompok_kerja_id,
                'created_at'        => date('Y-m-d'),
                'updated_at'        => date('Y-m-d'),
            ];
        }
        \DB::table('pola_kerja_kelompok_karyawan')->insert($dataPolaKerja);

        // proses simpan data pola kerja karyawan 
        $polaKerjaKaryawan = [];
        $karyawan = \DB::table('anggota_kelompok_kerja')
            ->where('kelompok_kerja_id', $request->kelompok_kerja_id)
            ->get();

        foreach ($karyawan as $k) {
            foreach ($period as $key => $value) {
                $polaKerjaKaryawan[] = [
                    'nik' => $k->nik,
                    'pola_kerja_id' => $request->pola_kerja,
                    'tanggal' => $value->format('Y-m-d')
                ];
            }
        }

        \DB::table('pola_kerja_karyawan')->insert($polaKerjaKaryawan);


        return redirect('kelompokkerja/' . $request->kelompok_kerja_id . '/polakerja')->with('message', 'Data Pola Kerja Kelompok Kerja Karyawan Berhasil di Tambah');
    }

    public function hapusPolaKerjaKelompok($id)
    {

        $polaKerja = \DB::table('pola_kerja_kelompok_karyawan')->where('id', $id)->first();
        \DB::table('pola_kerja_kelompok_karyawan')->where('id', $id)->delete();
        return redirect('kelompokkerja/' . $polaKerja->kelompok_kerja_id . '/polakerja')->with('message', 'Data Pola Kerja Kelompok Kerja Karyawan Tanggal ' . $polaKerja->tanggal . ' Berhasil di Hapus');
    }
}
