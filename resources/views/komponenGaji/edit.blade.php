@extends('template')
@section('title','Edit Komponen Gaji')
@section('content')
   
    @include('validation')
    <hr>
    {!! Form::model($komponenGaji,['url'=>'komponenGaji/'.$komponenGaji->kode_komponen,'method'=>'PUT']) !!}
        @include('komponenGaji.form')
    {!! Form::close() !!}
    
@endsection 