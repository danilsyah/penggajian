@extends('template')
@section('navigasi')
    <h1>
        Modul Karyawan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="karyawan/">Karyawan</a></li>
        <li class="active">Data Karyawan</li>
    </ol>
@endsection
@section('title','Data Karyawan')
@section('content')
@include('alert')
<a href="karyawan/create" class="btn btn-primary btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah</a>
<hr>
<table class="table table-hover" id="example1">
    <thead>
        <tr class="warning">
            <th width="50px">NIK</th>
            <th>Nama karyawan</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Departemen</th>
            <th>Tanggal Masuk</th>
            <th>Status Pegawai</th>
            {{-- <th>Gaji Pokok</th> --}}
            {{-- <th>Upah Per Jam</th> --}}
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($karyawan as $row)
        <tr>
            <td>{{$row->nik}}</td>
            <td>{{$row->nama}}</td>
            @if ($row->jenis_kelamin == 'P')
            <td>Perempuan</td>
            @else
            <td>Laki-Laki</td>
            @endif
            <td>{{$row->nama_jabatan}}</td>
            <td>{{$row->nama_departemen}}</td>
            <td>{{$row->tanggal_masuk}}</td>
            @if ($row->status_pegawai == 'P')
            <td><span class="label label-success">Karyawan Tetap</span> </td>
            @elseif($row->status_pegawai == 'K')
            <td><span class="label label-danger">Kontrak</span></td>
            @else
            <td>-</td>
            @endif
            {{-- <td>@currency($row->gaji_pokok)</td> --}}
            {{-- <td>@currency(upahPerHari($row->gaji_pokok))</td> --}}
            <td>
                @if($row->foto)
                    <img src="{{asset('uploads/'.$row->foto.'')}}"  width="80" alt="Foto Tidak Muncul">
                
                @else
                    <img src="{{asset('uploads/NoPhoto.png')}}"  width="90" alt="Foto Tidak Muncul">
                
                @endif
                
            </td>
            <td>
               <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/karyawan/{{$row->nik}}/kehadiran">Kehadiran</a></li>
                        <li><a href="/karyawan/{{$row->nik}}/lembur">Lembur</a></li>
                        <li><a href="/karyawan/{{$row->nik}}/polakerja">Pola Kerja</a></li>
                        <li><a href="/karyawan/{{$row->nik}}/edit">Edit</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="karyawan/{{$row->nik}}/delete" onclick="return confirm('Yakin Data Akan Di Hapus ?')">Hapus</a></li>
                    </ul>
               </div>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection

@push('script')
    <!-- DataTables -->
    <script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- page script -->
    
    <script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })    
    </script>
@endpush