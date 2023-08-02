@extends('adminlte::page')

@section('plugins.TempusDominusBs4', true)

@section('plugins.BsCustomFileInput', true)

@section('title', 'Edit Surat Masuk')

@section('content')
    <h1>Edit Surat Masuk</h1>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('masuk.update', $surat->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" class="form-control" placeholder="Nomor Surat" name="nomor_surat"
                        value="{{ $surat->nomor_surat }}">
                </div>

                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal_surat" required
                        value="{{ old('tanggal_surat') }}">
                </div>

                <div class="form-group">
                    <label>Alamat Surat</label>
                    <input type="text" name="alamat_surat" value="{{ $surat->alamat_surat }}" class="form-control"
                        placeholder="Alamat Surat">
                </div>

                <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" required value="{{ old('file') }}">
                </div>

                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" name="perihal" value="{{ $surat->perihal }}" class="form-control"
                        placeholder="Perihal">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <x-adminlte-select name="status">
                        <option {{ $surat->status == 0 ? 'selected' : '' }} value="0">Belum Disposisi</option>
                        <option {{ $surat->status == 1 ? 'selected' : '' }} value="1">Sudah Disposisi</option>
                    </x-adminlte-select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            {{-- <div class="card-footer">
                <button type="submit" class="btn btn-danger">Cancel</button>
            </div> --}}
        </form>
    </div>


@stop
