@extends('adminlte::page')

@section('title', 'Surat Masuk')

@section('content_header')

@section('content')
    {{-- With label, invalid feedback disabled and form group class --}}
    <div class="row">
        <x-adminlte-input name="nomor_surat" label="Nomor Surat" placeholder="placeholder" fgroup-class="col-md-6" disable-feedback />
    </div>
@stop
