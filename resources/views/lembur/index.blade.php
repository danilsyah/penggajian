@extends('template')
@section('title', 'Riwayat Lembur')
@section('content')
    @include('validation')
    @include('alert')

    <div class="row">
        <div class="col-md-4">
            {!! Form::open(['url' => 'ubah-periode-lembur']) !!}
            <table class="table table-bordered">
                <tr>
                    <td><a href="lembur/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Input Manual</a></td>
                    <td> <button type="submit" class="btn btn-danger">Filter</button></td>
                    <td width='900'>{!! Form::date('periodeLembur', null, ['class' => 'form-control']) !!}</td>
                </tr>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <table class="table table-hover" id="example1">
        <thead>
            <tr class="warning">
                <th width="50">NIK</th>
                <th>Nama Karyawan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th width="50">Durasi Lembur</th>
                <th>Kalender Kerja</th>
                <th>Upah</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayatLembur as $row)
                <tr>
                    <td>{{ $row->nik }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->tanggal_masuk }}</td>
                    <td>{{ $row->tanggal_pulang }}</td>
                    <td>{{ $row->durasi_lembur }}</td>
                    @if (isset($row->keterangan))
                        <td>{{ $row->keterangan }}</td>
                    @else
                        <td>Hari Kerja</td>
                    @endif
                    <td>@currency($row->upah)</td>
                    <td>{{ $row->periode }}</td>
                    <td>
                        {!! Form::open(['url' => 'hapus-riwayat-lembur/' . $row->id . '/' . 'lembur', 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin Akan Dihapus ?')">Hapus</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@push('script')
    <!-- DataTables -->
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@endpush
