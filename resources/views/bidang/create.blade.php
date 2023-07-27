@extends('adminlte::page')

@section('title', 'Tambah Bidang')

@section('content_header')
    <h1>Tambah Bidang</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Bidang</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('bidang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Bidang</label>
                    <input type="text" class="form-control" name="namabidang" placeholder="Nama Bidang" required
                        value="{{ old('namabidang') }}">
                </div>
               
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop