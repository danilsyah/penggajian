@extends('template')
@section('title','Riwayat Lembur')
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
             {!! Form::open(['url'=>'filter-lembur/'.$karyawan->nik]) !!}
             @include('karyawan.filter')
             {!! Form::close() !!}
             <table class="table table-bordered">
                <tr class="danger">
                    <th>Hari</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Pulang</th>
                    <th>Durasi Lembur</th>
                    <th>Kalender Kerja</th>
                    <th>Upah</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($riwayatLembur as $row)
                <tr>
                    <td>{{$noUrut++}}</td>
                    <td>{{$row->tanggal_masuk}}</td>
                    <td>{{$row->tanggal_pulang}}</td>
                    <td>{{$row->durasi_lembur}}</td>
                    @if (isset($row->keterangan))
                    <td>{{$row->keterangan}}</td>
                    @else
                    <td>Hari Kerja</td>
                    @endif
                    <td>@currency($row->upah)</td>
                    <td>
                        {!! Form::open(['url'=>'hapus-riwayat-lembur/'.$row->id.'/'.'karyawan','method'=>'delete']) !!}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Akan Dihapus ?')">Hapus</button>
                        {!! Form::close() !!}
                    </td>
                </tr>    
                @endforeach
             </table>
           
             <center>  {{ $riwayatLembur->links() }}</center>
         </div>
     </div>
@endsection