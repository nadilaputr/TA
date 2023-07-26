@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('content_header')

@stop

@section('content')
    <h1>Surat Keluar</h1>

    <a class="btn btn-info tambah-surat-masuk" href="{{ route('masuk.create') }}">Tambah</a>

        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach ($surat as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nomor_surat }}</td>
                    <td>{{ $row->tanggal_surat }}</td>
                    <td>{{ $row->alamat_surat }}</td>
                    <td>{{ $row->tanggal_masuk }}</td>
                    <td>{{ $row->perihal }}</td>
                    <td>{{ $row->status === 0 ? 'Belum Disposisi' : 'Sudah Disposisi' }}</td>
                    <td>{{ $row->file }}</td>


                    <form action="{{ route('masuk.destroy', $row->id) }}" method="POST">
                        <td class="d-flex">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('masuk.edit', $row->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
                                title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
    
                            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>

                            <button type="button" data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default btn-detail
                        text-success mx-1 shadow"
                                title="Detail">
                                <i class="fa fa-lg fa-fw fa-info-circle"></i>
                            </button>
                        </td>
                    </form>

                </tr>
            @endforeach
        </x-adminlte-datatable>
@stop

