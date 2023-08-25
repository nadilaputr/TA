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
                    <td>{!! $tindakanSurat->toBadge($row->surat_masuk->tindakan) !!}</td>
                    <td>{!! $row->bidang->bidang !!}</td>
                    <td>
                        @if ($row->surat_masuk->tindakan == SELESAI)
                            <a href="{{ route('disposisi.print', $row->id) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-cetak-tindakan"
                                title="Cetak Disposisi">
                                <i class="fa fa-lg fa-fw fa-file"></i>
                            </a>
                        @else
                            <button type="button" data-toggle="modal" data-target="#terimaModal"
                                data-id="{{ $row->surat_masuk->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-terima-tindakan"
                                title="Terima Disposisi">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach

        </x-adminlte-datatable>

        @include('disposisi.terima')
    </div>
@stop


@section('js')
    <script>
        $(document).ready(function() {

            let suratId;

            $('.btn-terima-tindakan').on('click', function() {
                suratId = $(this).data('id')
                $('.pdfContainer').hide();
                const url = '{{ route('suratmasuk.show', ':suratId') }}'.replace(':suratId', suratId);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        $('.id').html(data.data.id);
                        $('.nomor_surat').html(data.data.nomor_surat);
                        $('.tanggal_surat').html(data.data.tanggal_surat);
                        $('.asal_surat').html(data.data.asal_surat);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.perihal').html(data.data.perihal);
                        $('.jenis').html(data.data.jenis);
                        $('.downloadFile').attr('href', '{{ Storage::url(':file') }}'.replace(
                            ':file', data.data.file))
                        $('.pdfViewerBtn').attr('data-url', '{{ Storage::url(':file') }}'
                            .replace(':file', data.data.file))
                    },
                });
            });

            $('#terimaTindakanSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                const form = $('#terimaForm');
                const formData = new FormData(form[0]);
                const url = '{{ route('suratmasuk.updateTindakan', ':suratId') }}'.replace(':suratId',
                    suratId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false, // Don't process the data (already in FormData)
                    contentType: false, // Don't set content type (handled by FormData)
                    success: function(response) {
                        window.location.href = '{{ route('disposisi.index') }}';
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            const errors = JSON.parse(xhr.responseText)

                            // Clear previous error messages
                            $('.invalid-feedback').empty();
                            $('.is-invalid').removeClass('is-invalid');

                            // Iterate through each error and display next to the input
                            $.each(errors, function(field, messages) {
                                const input = $('[name="' + field + '"]');
                                const errorContainer = input.siblings(
                                    '.invalid-feedback');
                                errorContainer.text(messages[0]);
                                input.addClass('is-invalid');
                            });
                        } else {
                            alert('Terjadi kesalahan pada server!');
                        }
                    }
                });
            });
            $('.pdfViewerBtn').click(function(e) {
                const url = $(this).data('url');
                $('.pdfViewer').attr('src', url);
                $('.pdfContainer').show();
            })
        })
    </script>
@stop
