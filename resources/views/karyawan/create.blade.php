@extends('template')
@section('title','Tambah Karyawan')
@section('content')
    @include('validation')
    <script>
            function OnChange(value){
                gajiPokok = document.formKaryawan.gaji_pokok.value;
                upahPerJam = gajiPokok / 173;
                document.formKaryawan.upahPerJam.value = upahPerJam;
            }
    </script>
    <hr>
    {!! Form::open(['url'=>'karyawan','files'=>true, 'id'=>'formKaryawan', 'name'=>'formKaryawan']) !!}
    @include('karyawan.form')
    {!! Form::close() !!}
@endsection

