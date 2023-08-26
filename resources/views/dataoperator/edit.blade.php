@extends('adminlte::page')

@section('title', 'Edit Data Operator')

@section('content_header')
    <h1>Edit Data Operator</h1>
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
            <h3 class="card-title">Form Edit Data Operator</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('dataoperator.update', $edit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama" required
                        value="{{ $edit->name }}">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required
                        value="{{ $edit->username }}">
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" required value="{{ $edit->jabatan }}">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" id="bidang" name="id_bidang">
                        @foreach ($bidang as $row)
                            <option value="{{ $row->id }}" {{ $row->id == $edit->id_bidang? 'selected' : '' }}>
                                {{ $row->bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop