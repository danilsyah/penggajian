@extends('template')
@section('title','Edit Kalender Kerja')
@section('content')
   
    @include('validation')
    <hr>
    {!! Form::model($kalenderkerja,['url'=>'kalenderkerja/'.$kalenderkerja->id,'method'=>'PUT']) !!}
        @include('kalenderkerja.form')
    {!! Form::close() !!}
    
@endsection