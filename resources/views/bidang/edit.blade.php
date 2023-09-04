@extends('adminlte::page')

@section('title', 'Edit Bidang')

@section('content_header')
    <h1>Edit Bidang</h1>
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
        <div class="card-body">
            <form action="{{ route('bidang.update', $bidang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Bidang</label>
                    <input type="text" class="form-control" name="namabidang" placeholder="Nama" required
                        value="{{ $bidang->namabidang }}">
                </div>
               
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop