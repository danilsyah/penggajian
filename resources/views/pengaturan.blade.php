@extends('template')
@section('title','Pengaturan Profil Instansi')
@section('content')
@include('validation')
@include('alert')

{!! Form::model($pengaturan,['url'=>'pengaturan','files'=>true]) !!}

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <td width="150"><b>Nama Perusahaan</b></td>
                    <td>{!! Form::text('nama_perusahaan',null, ['class'=>'form-control','placeholder'=>'isi Nama
                        Perusahaan']) !!}</td>
                </tr>
                <tr>
                    <td><b>Alamat</b></td>
                    <td>{!! Form::text('alamat_perusahaan',null, ['class'=>'form-control','placeholder'=>'Isi Alamat
                        Perusahaan']) !!}
                    </td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{!! Form::text('email',null, ['class'=>'form-control','placeholder'=>'isi email']) !!}</td>
                </tr>
                <tr>
                    <td><b>No_Telepon</b></td>
                    <td>{!! Form::text('no_telepon',null, ['class'=>'form-control','placeholder'=>'Isi no telepon']) !!}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true">
                                Simpan</i></button>
                        <a href="/departemen" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true">
                                Batal</i></a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table table-bordered">
                <tr><td><img src="{{asset('uploads/'.$pengaturan->logo.'')}}"  width="200" alt="Logo Tidak Muncul"></td></tr>
                <tr><td>{!! Form::file('logo') !!}</td></tr>
            </table>
        </div>
    </div>

{!! Form::close() !!}
@endsection
