@extends('template')
@section('title','Gaji Karyawan')
@section('content')
@include('validation')
@include('alert')

    <div class="row">
        <div class="col-md-4">
{{-- filter --}}
            <h4>Filter Laporan</h4>
            <hr>
            {!! Form::open(['url'=>'ubah-periode-gaji']) !!}
            <table class="table table-bordered">
                <tr>
                    <td width="150">Periode Laporan</td>
                    <td>{!! Form::select('periode', $periodeGaji, null, ['class'=>'form-control']) !!}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-danger">Filter </button></td>
                </tr>
            </table>
            {!! Form::close() !!}
{{-- end filter table --}}
{{--   --}}
            <h4>Input Periode Gaji</h4>
            <hr>
            {!! Form::open(['url'=>'gaji']) !!}
            <table class="table table-bordered">
                <tr>
                    <td width="150">Periode Gaji</td>
                    <td>{!! Form::text('periode', null, ['class'=>'form-control','placeholder'=>'ex : 201908']) !!}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-danger">Generate</button></td>
                </tr>
            </table>
            {!! Form::close() !!}
        </div>
        <div class="col-md-8">
            <table class="table table-hover" id="example1">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Karyawan</>
                        <th>Periode Gaji</th>
                        <th>Detail</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($riwayatGaji as $row)
                        <tr>
                            <td>{{$row->nik}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->periode}}</td>
                            <td><a href="/gaji/{{$row->id}}" class="btn btn-success">Detail</a></td>
                            <td><a href="/gaji/{{$row->id}}/pdf" class="btn btn-danger">Slip Gaji</a></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
