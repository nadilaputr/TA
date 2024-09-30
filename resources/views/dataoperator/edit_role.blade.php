@extends('adminlte::page')

@section('title', 'Ubah Role Operator')

@section('content_header')
    <h1>Ubah Role Operator</h1>
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
            <h3 class="card-title">Form Ubah Role Operator</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('dataoperator.updateRole', $operator->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" id="role" name="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ $role == $operatorRole ? 'selected' : '' }}>
                                {{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@stop