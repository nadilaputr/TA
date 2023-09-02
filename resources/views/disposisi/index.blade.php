@extends('adminlte::page')

@section('title', 'Disposisi')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@php
    $config['order'] = [];
@endphp

@section('content')

    <h1>Disposisi</h1>

    <div class="container-fluid mt-5">
        <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" striped hoverable with-buttons>
            @foreach ($disposisi as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->surat_masuk->nomor_surat !!}</td>
                    <td>{!! $row->surat_masuk->perihal !!}</td>
                    <td>{!! $row->surat_masuk->asal_surat !!}</td>
                    <td>{!! $row->catatan !!}</td>
                    <td>{!! $tindakanSurat->toBadge($row->surat_masuk->tindakan) !!}</td>
                    <td>{!! $row->bidang->bidang !!}</td>
                    <td>
                        @if ($row->surat_masuk->tindakan == ARSIP)
                            <a href="{{ route('disposisi.print', $row->id) }}"
                                class="btn btn-xs btn-default text-secondary mx-1 shadow btn-cetak-tindakan"
                                title="Cetak Disposisi">
                                <i class="fa fa-lg fa-fw fa-print"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
@stop


@section('js')
    <script>
        $(document).ready(function() {

            $('.pdfViewerBtn').click(function(e) {
                const url = $(this).data('url');
                $('.pdfViewer').attr('src', url);
                $('.pdfContainer').show();
            })
        })
    </script>
@stop
