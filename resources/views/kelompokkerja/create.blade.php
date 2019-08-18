@extends('template')
@section('title','Tambah Kelompok Kerja')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'kelompokkerja']) !!}
        @include('kelompokkerja.form')
    {!! Form::close() !!}
@endsection