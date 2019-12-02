@extends('template')
@section('title','Detail Gaji Karyawan')
@section('content')
@include('validation')
@include('alert')

<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered">
            <tr>
                <td>
                    @if($karyawan->foto)
                    <img src="{{asset('uploads/'.$karyawan->foto.'')}}" width="200" alt="Foto Tidak Muncul">
                    @else
                    <img src="{{asset('uploads/NoPhoto.png')}}" width="200" alt="Foto Tidak Muncul">
                    @endif
                </td>
            </tr>
            <tr>
                <td>{{$karyawan->nama}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-8">
        {!! Form::open(['url'=>'tambah-komponen-gaji-detail']) !!}
        {!! Form::hidden('gaji_id', $gaji->id) !!}
        <table class="table table-hover">
            <tr>
                @if (Auth::user()->is_admin == 1) 
                <td width=500>{!! Form::select('kode_komponen', $komponenGaji, null, ['class'=>'form-control select2']) !!}</td>
                @endif
                <td>
                    @if (Auth::user()->is_admin==1)
                    <button type="submit" class="btn btn-primary">Tambah</button> / 
                    @endif
                    <a href="/gaji/{{$gaji->id}}/pdf" class="btn btn-success">Download Slip Gaji</a>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
        <table class="table table-hover">
            <tr class="info">
                <th>Komponen Gaji</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>Tetap</td>
                <td>@currency($karyawan->gaji_pokok)</td>
                <td></td>
            </tr>
            <tr>
                <td>Tunjangan Jabatan</td>
                <td>Tunjangan</td>
                <td>@currency($karyawan->tunjangan_jabatan)</td>
                <td></td>
            </tr>
            <tr>
                <td>Upah Lembur</td>
                <td>Lembur</td>
                <td>@currency($upahLembur[0]->upah)</td>
                <td></td>
            </tr>
            {{-- menghitung tunjangan / potongan  --}}
            <?php
                    $pendapatanTambahan = 0;
                ?>
            @if (isset($gajiDetail))
            @foreach ($gajiDetail as $row)
            <tr>
                <td>{{$row->nama_komponen}}</td>
                <td>{{$row->jenis}}</td>
                <td>@currency($row->nilai)</td>
                <td>
                    @if (Auth::user()->is_admin == 1)
                    {!! Form::open(['url'=>'hapus-komponen-gaji-detail/'.$row->id,'method'=>'delete']) !!}
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Yakin akan di Hapus ?')">Hapus</button>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            <?php
                            if ($row->jenis == 'tunjangan')
                            {
                                $pendapatanTambahan = $pendapatanTambahan + $row->nilai;
                            }
                            else{
                                // jika potongan maka di kurangi
                                $pendapatanTambahan = $pendapatanTambahan - $row->nilai;
                            }
                        ?>
            @endforeach
            @endif


            {{-- menghitung total gaji dan lembur --}}
            <?php
                    $total = $karyawan->gaji_pokok + $karyawan->tunjangan_jabatan + $pendapatanTambahan + $upahLembur[0]->upah ;
                ?>
            
            <tr class="info">
                <td><b>TOTAL GAJI</b></td>
                <td></td>
                <td class="totalGaji">@currency($total)</td>
                @if (Auth::user()->is_admin==1)
                {!! Form::open(['url'=>'totalgaji/'.$gaji->id]) !!}
                {!! Form::hidden('totalGaji', $total) !!}
                <td><button type="submit" class="btn btn-primary">Submit</button></td>
                {!! Form::close() !!}
                @endif
            </tr>
        </table>
    </div>
</div>

{{-- tabel riwayat kehadiran dan lembur --}}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Riwayat Kehadiran & Lembur</b></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="danger">Tanggal</th>
                            <?php
                                                $month = substr($periode,5,2);
                                                $year = substr($periode,0,4);
                                                for($d = 1; $d<=31; $d++){
                                                    $time = mktime(12, 0, 0, $month, $d, $year);
                                                    if(date('m',$time)==$month){
                                                        echo "<td class='danger'>".date('d',$time)."</td>";
                                                    }
                                                }
                                            ?>
                        </tr>
                        <tr>
                            <th class="success">Kehadiran</th>
                            <?php
                                                $month = substr($periode,5,2);
                                                $year = substr($periode,0,4);
                                                for($d = 1; $d<=31; $d++){
                                                    $time = mktime(12, 0, 0, $month, $d, $year);
                                                    if(date('m',$time)==$month){
                                                        echo "<td class='success'>".cekKehadiran($karyawan->nik,date('Y-m-d',$time))."</td>";
                                                    }
                                                }
                                            ?>
                        </tr>
                        <tr>
                            <th class="warning">Lembur</th>
                            <?php
                                                $month = substr($periode,5,2);
                                                $year = substr($periode,0,4);
                                                for($d = 1; $d<=31; $d++){
                                                    $time = mktime(12, 0, 0, $month, $d, $year);
                                                    if(date('m',$time)==$month){
                                                        echo "<td class='warning'>".cekLembur($karyawan->nik,date('Y-m-d',$time))."</td>";
                                                    }
                                                }
                                            ?>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-footer">
                <strong>Keterangan = H : Hadir , I : Ijin , C : Cuti , A : Alfa , S : Sakit</strong><br>
            </div>
        </div>
    </div>
</div>
@endsection
