@extends('template')
@section('title','Input Data Lembur')
@section('content')
    @include('validation')
    @include('alert')
    {!! Form::open(['url'=>'lembur']) !!}
        @include('lembur.form')
    {!! Form::close() !!}
    
@endsection