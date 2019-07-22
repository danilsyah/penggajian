@extends('template')
@section('title','Tambah KalenderKerja')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'kalenderkerja']) !!}
        @include('kalenderkerja.form')
    {!! Form::close() !!}
    
@endsection 