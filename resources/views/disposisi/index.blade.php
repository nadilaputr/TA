@extends('adminlte::page')

@section('title', 'Disposisi')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content')
    <h1>Disposisi</h1>


    <div class="container-fluid mt-5">
       <x-adminlte-datatable id="table5" :heads="$heads" striped hoverable with-buttons>
        @foreach ($disposisi as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->surat_masuk->nomor_surat !!}</td>
                <td>{!! $row->surat_masuk->perihal !!}</td>
                <td>{!! $row->surat_masuk->asal_surat !!}</td>
                <td>{!! $row->catatan !!}</td>
                <td>{!! $row->bidang->bidang !!}</td>
                <td class="d-flex">
                    <button type="button" data-toggle="modal" data-target="#editmodal{{ $row->id }}"
                        class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>
@stop

