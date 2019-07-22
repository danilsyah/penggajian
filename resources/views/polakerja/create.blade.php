@extends('template')
@section('title','Tambah Pola Kerja')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'polakerja']) !!}
        @include('polakerja.form')
    {!! Form::close() !!}
    
@endsection 