@extends('template')
@section('title','Tambah Departemen')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'departemen']) !!}
        @include('departemen.form')
    {!! Form::close() !!}
    
@endsection 