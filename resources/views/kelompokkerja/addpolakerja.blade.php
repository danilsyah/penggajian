@extends('template')
@section('title','Pola Kerja Kelompok Karyawan')
@section('content')
@include('validation')
@include('alert')
    <div class="row">
        <div class="col-md-5">
            {!! Form::open(['url'=>'simpan-pola-kerja-kelompok-karyawan']) !!}
            {!! Form::hidden('kelompok_kerja_id', $kelompokKerja->id) !!}
            <table class="table table-bordered">
                <tr>
                    <th>Nama Kelompok</th>
                    <td><u>{{$kelompokKerja->kelompok_kerja}}</u></td>
                </tr>
                <tr>
                    <th>Dari Tanggal</th>
                    <td>{!! Form::date('dari_tanggal',null, ['class'=>'form-control']) !!}</td>
                </tr>
                <tr>
                    <th>Sampai Tanggal</th>
                    <td>{!! Form::date('sampai_tanggal',null, ['class'=>'form-control']) !!}</td>
                </tr>
                <tr>
                    <th>Pola Kerja</th>
                    <td>{!! Form::select('pola_kerja', $polaKerja, null, ['class'=>'form-control']) !!}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Simpan</button></td>
                </tr>
            </table>
            {!! Form::close() !!}
        </div>
        <div class="col-md-7">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Pola Kerja</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($polaKerjaKelompok as $row)
                <tr>
                    <td>{{ date('l', strtotime($row->tanggal)) }} {{ date_format(date_create($row->tanggal),"d-m-Y") }}</td>
                    <td>{{$row->pola_kerja}}</td>
                    <td>{{$row->jam_masuk}}</td>
                    <td>{{$row->jam_pulang}}</td>
                    <td width=100px>
                        {!! Form::open(['url'=>'hapus-pola-kerja-kelompok-karyawan/'.$row->id,'method'=>'delete','onsubmit'=>'return confirm("Yakin Data Akan Dihapus ?")']) !!}
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </table>
            {{$polaKerjaKelompok->links()}}
        </div>
    </div>
    
@endsection