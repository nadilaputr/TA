@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content_header')

@stop

@section('content')
    <h3 class="mt-3">Surat Keluar</h3>

    <button class="btn btn-info btn-create mb-3" data-toggle="modal" data-target="#createModal">Tambah</button>

    @if ($message = Session::get('massage'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <x-adminlte-datatable id="table7" :heads="$heads"  striped hoverable with-buttons>

        @foreach ($suratkeluar as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->nomor_surat }}</td>
            <td>{{ $row->sifat }}</td>
            <td>{{ $row->alamat_surat }}</td>
            {{-- <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td> --}}
            <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST">
                <td class="d-flex">
                    {{-- @csrf --}}
                    {{-- @method('DELETE') --}}
                    <button type="button" data-toggle="modal" data-target="#deleteModalSuratMasuk" data-id="{{ $row->id }}"
                        class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>

                    <button type="button" data-toggle="modal" data-target="#editModal" data-id="{{ $row->id }}"
                        class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>

                    <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                        title="Detail" data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}">
                        <i class="fa fa-lg fa-fw fa-info-circle"></i>
                    </button>

                    <a href="{{ Storage::url($row->file) }}" target="_blank"
                        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                        <i class="fa fa-lg fa-fw fa-file"></i>
                    </a>

                    <button type="button" data-toggle="modal" data-target="#editTindakanModal"
                        data-id="{{ $row->id }}"
                        class="btn btn-xs btn-default btn-edit-tindakan text-success mx-1 shadow" title="Edit Tindakan">
                        <i class="fa fa-lg fa-fw fa-share-square"></i>
                    </button>
                </td>
            </form>
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop
