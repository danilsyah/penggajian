@extends('template')
@section('title','Tambah Karyawan')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'karyawan','files'=>true]) !!}
    @include('karyawan.form')
    {!! Form::close() !!}
@endsection