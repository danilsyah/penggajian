@extends('template')
@section('title','Edit Pola Kerja')
@section('content')
   
    @include('validation')
    <hr>
    {!! Form::model($polaKerja,['url'=>'polakerja/'.$polaKerja->id,'method'=>'PUT']) !!}
        @include('polakerja.form')
    {!! Form::close() !!}
    
@endsection 
