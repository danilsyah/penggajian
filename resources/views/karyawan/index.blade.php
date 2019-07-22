@extends('template')
@section('title','Data Karyawan')
@section('content')
@include('alert')
<a href="karyawan/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah</a>
<hr>
<table class="table table-hover" id="example1">
    <thead>
        <tr class="warning">
            <th width="50px">NIK</th>
            <th>Nama karyawan</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Status Kawin</th>
            <th>Jabatan</th>
            <th>Departemen</th>
            <th>Tanggal Masuk</th>
            <th>Foto</th>
            <th>Aksi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($karyawan as $row)
        <tr>
            <td>{{$row->nik}}</td>
            <td>{{$row->nama}}</td>
            <td>{{$row->tanggal_lahir}}</td>
            <td>{{$row->jenis_kelamin}}</td>
            <td>{{$row->keterangan}}</td>
            <td>{{$row->nama_jabatan}}</td>
            <td>{{$row->nama_departemen}}</td>
            <td>{{$row->tanggal_masuk}}</td>
            <td>
                @if($row->foto)
                    <img src="{{asset('uploads/'.$row->foto.'')}}"  width="80" alt="Foto Tidak Muncul">
                
                @else
                    <img src="{{asset('uploads/NoPhoto.png')}}"  width="90" alt="Foto Tidak Muncul">
                
                @endif
                
            </td>
            <td width="50"><a href="/karyawan/{{$row->nik}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            </td>
            <td width="50">
                {{Form::open(['url'=>'karyawan/'.$row->nik,'method'=>'delete'])}}
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                {{Form::close()}}
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