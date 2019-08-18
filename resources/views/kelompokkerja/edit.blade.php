@extends('template')
@section('title','Edit Kelompok Kerja')
@section('content')

    @include('validation')
    <hr>
    {!! Form::model($kelompokKerja,['url'=>'kelompokkerja/'.$kelompokKerja->id,'method'=>'PUT']) !!}
        @include('kelompokkerja.form')
    {!! Form::close() !!}
    
@endsection 