@extends('template')
@section('title','Riwayat Kehadiran')
@section('content')
    @include('validation')
    @include('alert')
    @include('karyawan.tab')
    
     <div class="row">
         <div class="col-md-3">
            <table class="table table-bordered">
                <tr>
                    <td>
                        @if($karyawan->foto)
                            <img src="{{asset('uploads/'.$karyawan->foto.'')}}"  width="200" alt="Foto Tidak Muncul">
                        @else
                            <img src="{{asset('uploads/NoPhoto.png')}}"  width="200" alt="Foto Tidak Muncul">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{$karyawan->nama}}</td>
                </tr>
            </table>
         </div>
         <div class="col-md-9">
             {!! Form::open(['url'=>'filter-kehadiran/'.$karyawan->nik]) !!}
             @include('karyawan.filter')
             {!! Form::close() !!}
             <table class="table table-bordered">
                <tr class="danger">
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Pola Kerja</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Absen Masuk</th>
                    <th>Absen Pulang</th>
                </tr>
                @foreach ($riwayatKehadiran as $row)
                <tr>
                    <td>{{$noUrut++}}</td>
                    <td>{{ date('l', strtotime($row->tanggal_masuk)) }} {{ date_format(date_create($row->tanggal_masuk),"d-m-Y") }}</td>
                    <td>{{$row->pola_kerja}}</td>
                    <td>{{$row->jam_masuk}}</td>
                    <td>{{$row->jam_pulang}}</td>
                    <td>{{$row->tanggal_masuk}}</td>
                    <td>{{$row->tanggal_pulang}}</td>
                </tr>    
                @endforeach
             </table>
            <center> {{ $riwayatKehadiran->links() }} </center>
         </div>
     </div>
@endsection