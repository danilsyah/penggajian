@extends('template')
@section('title','Edit Karyawan')
@section('content')
    @include('validation')
    @include('karyawan.tab')
    <hr>
    {!! Form::model($karyawan,['url'=>'karyawan/'.$karyawan->nik,'method'=>'PUT','files'=>true]) !!}
    @include('karyawan.form')
    {!! Form::close() !!}
@endsection