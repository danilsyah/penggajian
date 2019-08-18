@extends('template')
@section('navigasi')
    <h1>
        Modul Karyawan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="departemen/">Departemen</a></li>
        <li class="active">Data Departemen</li>
    </ol>
@endsection
@section('title','Data Departemen')
@section('content')
@include('alert')
<a href="departemen/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah</a>
<hr>
<table class="table table-hover" id="example1">
    <thead>
        <tr class="warning">
            <th width="200px">Kode Departemen</th>
            <th>Nama Departemen</th>
            <th>Aksi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departemen as $row)
        <tr>
            <td>{{$row->kode_departemen}}</td>
            <td>{{$row->nama_departemen}}</td>
            <td width="50"><a href="/departemen/{{$row->kode_departemen}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            </td>
            <td width="50">
                {{Form::open(['url'=>'departemen/'.$row->kode_departemen,'method'=>'delete','onsubmit'=>'return confirm("Yakin Data Akan Dihapus ?")'])}}
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