@extends('template')
@section('title','Detail Gaji Karyawan')
@section('content')
    @include('validation')
    @include('alert')

    <div class="row">
        <div class="col-md-4">
           <table class="table table-bordered">
                <tr>
                    <td>
                        @if($karyawan->foto)
                            <img src="{{asset('uploads/'.$karyawan->foto.'')}}"  width="200" alt="Foto Tidak Muncul">
                        @else
                            <img src="{{asset('uploads/NoPhoto.png')}}"  width="200" alt="Foto Tidak Muncul">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{$karyawan->nama}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-8">
            <table class="table table-hover">
                <tr>
                    <td>{!! Form::select('komponen', $komponenGaji, null, ['class'=>'form-control']) !!}</td>
                    <td><button type="submit" class="btn btn-google">Tambah</button></td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Komponen Gaji</th>
                    <th>Nominal</th>
                </tr>
                <tr>
                    <td>Gaji Pokok</td>
                    <td>@currency($karyawan->gaji_pokok)</td>
                </tr>
                <tr>
                    <td>Tunjangan Jabatan</td>
                    <td>@currency($karyawan->tunjangan_jabatan)</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
