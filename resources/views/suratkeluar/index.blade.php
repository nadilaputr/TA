@extends('adminlte::page')

@section('title', 'Surat Keluar')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content_header')

@stop


@section('content')
    <h3 class="mt-3">Surat Keluar</h3>
    @role('admin')
        <button class="btn btn-info btn-create mb-3" data-toggle="modal" data-target="#createModalKeluar">Tambah</button>
    @endrole

    @if ($message = Session::get('massage'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <x-adminlte-datatable id="table7" :heads="$heads" striped hoverable with-buttons>

        @foreach ($suratkeluar as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $row->bidang->bidang }}</td>
                <td>{{ $row->sifat }}</td>
                <td>{{ $row->alamat_surat }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $dateFormat->from($row->tanggal_surat) }}</td>
                <td>{{ $row->lampiran }}</td>

                {{-- <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td> --}}
                <td class="d-flex">
                    {{-- @csrf --}}
                    {{-- @method('DELETE') --}}

                    {{-- <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail" title="Detail"
                        data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}">
                        <i class="fa fa-lg fa-fw fa-info-circle"></i>
                    </button> --}}
                    <a href="{{ Storage::url($row->file) }}" target="_blank"
                        class="btn btn-xs btn-default text-secondary mx-1 shadow" title="Lihat File">
                        <i class="fa fa-lg fa-fw fas fa-print"></i>
                    </a>
                    @role('admin')
                    <button type="button" data-toggle="modal" data-target="#editModal" data-id="{{ $row->id }}"
                        class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#deleteModalSuratKeluar"
                        data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                        title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                    @endrole
            </tr>
        @endforeach
    </x-adminlte-datatable>
    @include('suratkeluar.create')
    @include('suratkeluar.delete')
    @include('suratkeluar.edit')
    {{-- @include('suratkeluar.show') --}}


@stop
@section('js')
    <script>
        $(document).ready(function() {
            let suratkeluarId;

            // When the delete button in the modal is clicked, send an AJAX request to delete the operator
            $('#confirmDeleteSuratKeluarBtn').on('click', function() {

                if (suratkeluarId) {
                    $.ajax({
                        type: 'POST',
                        url: `/suratkeluar/${suratkeluarId}`, // Replace with the actual delete route URL
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#deleteModalSuratKeluar').modal('hide');
                            window.location.href = "{{ route('suratkeluar.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting Surat Keluar:', error);
                            $('#deleteModalSuratKeluar').modal('hide');
                        }
                    });
                }
            });

            // When the delete button in the table is clicked, store the operator ID to be deleted
            $('.btn-delete').on('click', function() {
                suratkeluarId = $(this).data('id');
            });

            $('#createSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#createForm');
                const formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratkeluar.index') }}';
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

            $('.btn-edit').click(function(e) {
                suratkeluarId = $(this).data('id');

                const url = '{{ route('suratkeluar.edit', ':suratkeluarId') }}'.replace(':suratkeluarId',
                    suratkeluarId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#editNomorSurat').val(response.suratkeluar.nomor_surat);
                        $('#editAlamatSurat').val(response.suratkeluar.alamat_surat);
                        $('#editTanggalSurat').val(response.suratkeluar.tanggal_surat);
                        $('#editPerihal').val(response.suratkeluar.perihal);
                        $('#editBidang').val(response.suratkeluar.id_bidang);
                        $('#editLampiran').val(response.suratkeluar.lampiran);
                        $('#editSifat').val(response.suratkeluar.sifat);
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching data');
                    }
                });
            })

            $('#editSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#editForm');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratkeluar.update', ':suratkeluarId') }}'.replace(':suratkeluarId',
                    suratkeluarId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratkeluar.index') }}';
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

            // $('.btn-detail').on('click', function(event) {

            //     $('.pdfContainer').hide();

            //     var id = $(this).data('id');

            //     $.get(`suratkeluar/${id}`, function(data) {
            //         $('.id').html(data.data.id);
            //         $('.nomor_surat').html(data.data.nomor_surat);
            //         $('.tanggal_surat').html(data.data.tanggal_surat);
            //         $('.alamat_surat').html(data.data.alamat_surat);
            //         $('.perihal').html(data.data.perihal);
            //         $('.sifat').html(data.data.sifat);
            //         $('.lampiran').html(data.data.lampiran);
            //         $('.pdfViewerBtn').attr('data-url', '{{ Storage::url(':file') }}'
            //             .replace(':file', data.data.file))
            //     })
            // });

        });
    </script>
@stop
