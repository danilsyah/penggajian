@extends('template')
@section('title','Edit Jabatan')
@section('content')
   
    @include('validation')
    <hr>
    {!! Form::model($jabatan,['url'=>'jabatan/'.$jabatan->kode_jabatan,'method'=>'PUT']) !!}
        @include('jabatan.form')
    {!! Form::close() !!}
    
@endsection 
