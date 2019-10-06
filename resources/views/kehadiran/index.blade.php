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
                    <td><a href="kehadiran/create" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah Manual</a></td>
                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-excel-o"></i> Export Absensi</button></td>
                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1"><i class="fa fa-file-excel-o"></i> Import Absensi</button></td>
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
                     @if (isset($row->status_kehadiran))
                        <td>
                            {!! Form::open(['url'=>'kehadiran/'.$row->id,'method'=>'delete','onsubmit'=>'return confirm("Yakin Data Akan Dihapus ?")']) !!}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                            {!! Form::close() !!}
                        </td>
                     @else
                         <td></td>
                     @endif
                     
                 </tr>
             @endforeach
        </tbody>
    </table>

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Export Laporan Absensi</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['url'=>'export-laporan-kehadiran-excel']) !!}
          <table class="table table-bordered">
              <tr>
                  <td>Dari Tanggal</td>
                  <td>{!! Form::date('tanggal_mulai', null, ['class'=>'form-control']) !!}</td>
              </tr>
              <tr>
                <td>Sampai Tanggal</td>
                <td>{!! Form::date('tanggal_selesai', null, ['class'=>'form-control']) !!}</td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-success"> Download</button></td>
            </tr>
          </table>
        {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>

  <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Data Absensi</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url'=>'import-excel-kehadiran', 'files'=>true]) !!}
             <table class="table table-bordered">
                 <tr>
                     <td>Upload File</td>
                     <td>{!! Form::file('file', ['class'=>'form-control']) !!}</td>
                 </tr>
                 <tr>
                     <td></td>
                     <td><button type="submit" class="btn btn-success"> Submit</button></td>
                 </tr>
             </table>
            {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
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