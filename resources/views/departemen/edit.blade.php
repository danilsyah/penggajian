@extends('template')
@section('title','Edit Departemen')
@section('content')
   
    @include('validation')
    <hr>
    {!! Form::model($departemen,['url'=>'departemen/'.$departemen->kode_departemen,'method'=>'PUT']) !!}
        @include('departemen.form')
    {!! Form::close() !!}
    
@endsection 
