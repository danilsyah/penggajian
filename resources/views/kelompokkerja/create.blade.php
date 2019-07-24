@extends('template')
@section('title','Tambah Pola Kerja')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'kelompokkerja']) !!}
        @include('kelompokkerja.form')
    {!! Form::close() !!}
@endsection