@extends('template')
@section('title','Data Pola Kerja')
@section('content')
@include('alert')
<a href="polakerja/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah</a>
<hr>
<table class="table table-hover" id="example1">
    <thead>
        <tr class="warning">
            <th width="20px">Kode</th>
            <th>Pola Kerja</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Aksi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($polaKerja as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->pola_kerja}}</td>
                <td>{{$row->jam_masuk}}</td>
                <td>{{$row->jam_pulang}}</td>
                <td width="50px"><a href="/polakerja/{{$row->id}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
                <td width="50px">
                    {!! Form::open(['url'=>'polakerja/'.$row->id,'method'=>'delete', 'onsubmit'=>'return confirm("Yakin Data Akan Dihapus ?")']) !!}
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                    {!! Form::close() !!}
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