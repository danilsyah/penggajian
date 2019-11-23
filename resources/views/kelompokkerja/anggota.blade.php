@extends('template')
@section('title','Anggota Kelompok Kerja')
@section('content')
@include('validation')
@include('alert')
<hr>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <td width=200px><b>Nama Kelompok Kerja :</b></td>
                <td><b><i><u>{{$kelompokKerja->kelompok_kerja}}</u></i></b></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        {!! Form::open(['url'=>'tambah-kelompok-kerja']) !!}
            {!! Form::hidden('id', $kelompokKerja->id) !!}
            <table class="table table-hover">
                <tr>
                    <td>{!! Form::select('nik', $karyawan,null, ['class'=>'form-control select2']) !!}</td>
                    {{-- <td>{!! Form::text('nama', null, ['list'=>'karyawan','class'=>'form-control', 'placeholder'=>'Cari Nama atau Nik Karyawan']) !!}</td> --}}
                    <td><button type="submit" class="btn btn-bitbucket">Tambah Anggota</button></td>
                </tr>
            </table>
        {!! Form::close() !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
            <table class="table table-hover" id="example1">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $row)
                        <tr>
                            <td>{{$row->nik}}</td>
                            <td>{{$row->nama}}</td>
                            <td width=100px>
                                {!! Form::open(['url'=>'hapus-anggota-kelompok-kerja/'.$row->id,'method'=>'delete',
                                'onsubmit'=>'return confirm("Yakin Data Akan Dihapus ?")']) !!}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i>
                                    Hapus</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
    </div>
</div>

{{-- <datalist id="karyawan">
    @foreach ($karyawan as $row)
        <option value="{{$row->nama}}">
        {{ $nikKaryawan ='NIK : '. $row->nik }}
        </option>
    @endforeach
</datalist> --}}

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
