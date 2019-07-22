@extends('template')
@section('title','Tambah Jabatan')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'jabatan']) !!}
    <table class="table table-bordered">
        @include('jabatan.form')
    {!! Form::close() !!}
@endsection