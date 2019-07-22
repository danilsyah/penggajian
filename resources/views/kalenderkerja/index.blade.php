@extends('template')
@section('title','Data Kalender Kerja')
@section('content')
@include('alert')
    <a href="kalenderkerja/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah</a>
    <hr>
    <table class="table table-hover" id="example1">
        <thead>
            <tr class="warning">
                <th width="100">Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kalenderkerja as $row)
                <tr>
                    <td>{{$row->tanggal}}</td>
                    <td>{{$row->keterangan}}</td>
                    <td width="50"><a href="/kalenderkerja/{{$row->id}}/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
                    <td width="50">
                        {!! Form::open(['url'=>'kalenderkerja/'.$row->id,'method'=>'delete']) !!}
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