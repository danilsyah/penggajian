@extends('template')
@section('title','Tambah Komponen Gaji')
@section('content')
    @include('validation')
    <hr>
    {!! Form::open(['url'=>'komponenGaji']) !!}
    <table class="table table-bordered">
        @include('komponenGaji.form')
    </table>
    {!! Form::close() !!}
@endsection