@extends('template')
@section('title','Riwayat Kehadiran')
@section('content')
    @include('validation')
    @include('alert')

    <div class="row">
        <div class="col-md-4">
            {!! Form::open(['url'=>'ubah-periode-kehadiran']) !!}
            <table class="table table-bordered">
                <tr>
                    <td><a href="kehadiran/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah</a></td>
                    <td> <button type="submit" class="btn btn-danger">Filter</button></td>
                    <td width='900'>{!! Form::date('periodeKehadiran',null, ['class'=>'form-control']) !!}</td>
                </tr>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <table class="table table-hover" id="example1">
        <thead>
            <tr class="warning">
                <th width="100">NIK</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Pulang</th>
                <th>Status Kehadiran</th>
                <th>Aksi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
             @foreach ($kehadiran as $row)
                 <tr>
                     <td>{{$row->nik}}</td>
                     <td>{{$row->nama}}</td>
                     <td>{{$row->nama_departemen}}</td>
                     <td>{{$row->tanggal_masuk}}</td>
                     <td>{{$row->tanggal_pulang}}</td>
                     <td>{{$row->status_kehadiran}}</td>
                     <td><a href="kehadiran/{{$row->id}}/edit" class="btn btn-success btn-sm" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></td>
                     <td>
                         {!! Form::open(['url'=>'kehadiran/'.$row->id,'method'=>'delete']) !!}
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