@extends('adminlte::page')

@section('title', 'Ubah Password Operator')

@section('content_header')
    <h1>Ubah Password Operator</h1>
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
            <h3 class="card-title">Form Ubah Password Operator</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('dataoperator.updatePassword', $operator->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" name="password" placeholder="Password baru" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Konfirmasi password" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop