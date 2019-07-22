@extends('template')
@section('title','Tambah Status Kawin')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'statuskawin']) !!}
    <table class="table table-bordered">
        <tr>
            <td width="150"><b>Kode Status Kawin</b></td>
            <td>{!! Form::text('kode_status_kawin',null, ['class'=>'form-control','placeholder'=>'Isi Kode Status Kawin']) !!}</td>
        </tr>
        <tr>
            <td><b>Keterangan</b></td>
            <td>{!! Form::text('keterangan',null, ['class'=>'form-control','placeholder'=>'Isi Keterangan']) !!}</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
                <a href="/statuskawin" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
            </td>
        </tr>
        
</table>
    {!! Form::close() !!}
    
@endsection 