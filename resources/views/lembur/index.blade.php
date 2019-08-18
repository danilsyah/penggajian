@extends('template')
@section('title','Riwayat Lembur')
@section('content')
    @include('validation')
    @include('alert')

    <div class="row">
        <div class="col-md-4">
            {!! Form::open(['url'=>'ubah-periode-lembur']) !!}
            <table class="table table-bordered">
                <tr>
                    <td><a href="lembur/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Input Manual</a></td>
                    <td> <button type="submit" class="btn btn-danger">Filter</button></td>
                    <td width='900'>{!! Form::date('periodeLembur',null, ['class'=>'form-control']) !!}</td>
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
                <th>Tanggal Masuk</th>
                <th>Tanggal Pulang</th>
                <th>Durasi Lembur (Jam)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($riwayatLembur as $row)
                 <tr>
                     <td>{{$row->nik}}</td>
                     <td>{{$row->nama}}</td>
                     <td>{{$row->tanggal_masuk}}</td>
                     <td>{{$row->tanggal_pulang}}</td>
                     <td>{{$row->durasi_lembur}}</td>
                     <td>
                        {!! Form::open(['url'=>'hapus-riwayat-lembur/'.$row->id.'/'.'lembur','method'=>'delete']) !!}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Akan Dihapus ?')">Hapus</button>
                        {!! Form::close() !!}
                    </td>
                     {{-- @if (isset($row->status_kehadiran))
                        <td><a href="kehadiran/{{$row->id}}/edit" class="btn btn-success btn-sm" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></td>
                        <td>
                            {!! Form::open(['url'=>'kehadiran/'.$row->id,'method'=>'delete','onsubmit'=>'return confirm("Yakin Data Akan Dihapus ?")']) !!}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                            {!! Form::close() !!}
                        </td>
                     @else
                         <td></td>
                         <td></td>
                     @endif --}}
                     
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