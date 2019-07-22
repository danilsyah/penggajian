@extends('template')
@section('title','Tambah Data Kehadiran')
@section('content')
    @include('validation')
    @include('alert  ')
    <hr>
    {!! Form::open(['url'=>'kehadiran']) !!}
    <table class="table table-bordered">
        @include('kehadiran.form')
    {!! Form::close() !!}
@endsection