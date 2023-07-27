@extends('adminlte::page')

@section('plugins.TempusDominusBs4', true)

@section('plugins.BsCustomFileInput', true)

@section('title', 'Tambah Surat Masuk')

@section('content_header')

    @php
        $config = ['format' => 'L'];
    @endphp

@stop

@section('content')
    <h1>Tambah Surat Masuk</h1>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>


        <form action="{{ route('masuk.store') }}" enctype="multipart/form-data" method="POST">
            @csrf 

            <div class="card-body">
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" class="form-control" placeholder="Nomor Surat" name="nomor_surat" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <x-adminlte-input-date name="tanggal_surat" :config="$config" placeholder="bb/hh/tttt">
                        <x-slot name="appendSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>

                <div class="form-group">
                    <label>Alamat Surat</label>
                    <input type="text" name="alamat_surat" class="form-control" placeholder="Alamat Surat" required>
                </div>

                <div class="form-group">
                    <label>File</label>
                    <x-adminlte-input-file name="file" igroup-size="md" placeholder="Choose a file...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>

                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" name="perihal" class="form-control" placeholder="Perihal" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <x-adminlte-select name="status">
                        <option value="0">Belum Disposisi</option>
                        <option value="1">Sudah Disposisi</option>
                    </x-adminlte-select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


@stop
