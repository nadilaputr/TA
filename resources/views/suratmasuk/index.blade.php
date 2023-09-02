@extends('adminlte::page')

@section('title', 'Surat Masuk')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@php
    $config['order'] = [];
@endphp

@section('content')
    <h3 class="mt-3">Surat Masuk</h3>

    @role('admin')
        <button class="btn btn-info btn-create mb-3" data-toggle="modal" data-target="#createModal">Tambah</button>
    @endrole

    @if ($message = Session::get('massage'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <x-adminlte-datatable id="table7" :heads="$heads" :config="$config" striped hoverable with-buttons>

        @foreach ($surat as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $dateFormat->from($row->tanggal_masuk) }}</td>
                {{-- <td>{{ $row->tanggal_surat }}</td> --}}
                <td>{{ $row->asal_surat }}</td>
                <td>{{ $row->perihal }}</td>
                {{-- <td>{{ $row->jenis }}</td> --}}
                {{-- <td>{{ $row->catatan }}</td> --}}
                <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td>
                {{-- <form action="{{ route('suratmasuk.destroy', $row->id) }}" method="POST"> --}}
                <td class="d-flex" style="justify-content: center">
                    {{-- @csrf --}}
                    {{-- @method('DELETE') --}}

                    @role('sekretaris')
                        @if ($row->tindakan == DISPOSISI)
                            <button type="button" data-toggle="modal" data-target="#bidangModal" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-bidang" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                        @elseif($row->tindakan == DITERIMA)
                            <button type="button" data-toggle="modal" data-target="#ajukanModal" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-ajukan font-weight-bold"
                                title="Edit">
                                <span>Ajukan</span>
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                        @endif
                    @endrole

                    @role('kepaladinas')
                    @if($row->tindakan == MENUNGGU_INSTRUKSI_KEPALA)
                        <button type="button" data-toggle="modal" data-target="#disposisiKepalaModal"
                            data-id="{{ $row->id }}" class="btn btn-xs btn-default text-primary mx-1 shadow btn-disposisi"
                            title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    @endif
                    @endrole


                    @unlessrole('sekretaris|kepaladinas')
                        @if ($row->tindakan == ARSIP)
                            <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                                title="Detail" data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}">
                                <i class="fa fa-lg fa-fw fa-info-circle"></i>
                            </button>
                            {{-- <a href="{{ route('disposisi.print', $row->id) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow downloadFile" title="Cetak Disposisi">
                            <i class="fa fa-lg fa-fw fa-print"></i>
                        </a> --}}
                            <button type="button" data-toggle="modal" data-target="#deleteModalSuratMasuk"
                                data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                                title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        @elseif ($row->tindakan == REVISI)
                            <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                                title="Detail" data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}">
                                <i class="fa fa-lg fa-fw fa-info-circle"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#editModal" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#editTindakanModal"
                                data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default btn-edit-tindakan text-success mx-1 shadow" title="Edit Tindakan">
                                <i class="fa fa-lg fa-fw fa-share-square"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                                title="Detail" data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}">
                                <i class="fa fa-lg fa-fw fa-info-circle"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#editModal" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#deleteModalSuratMasuk"
                                data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                                title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        @endif
                    @endunlessrole
                </td>
                {{-- </form> --}}
            </tr>
        @endforeach
    </x-adminlte-datatable>

    @include('dashboard.ajukan_modal')
    @include('dashboard.tindakan_bidang_modal')
    @include('dashboard.disposisi_kepala_modal')
    @include('suratmasuk.delete')
    @include('suratmasuk.show')
    @include('suratmasuk.create')
    @include('suratmasuk.edit')
    @include('suratmasuk.edit_tindakan')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            let suratId;

            if ($("#tindakan").val() === "1") {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function() {
                var selectedOption = $(this).val();

                if (selectedOption === "1") {
                    $('#catatanContainer').show();
                } else {
                    $('#catatanContainer').hide();
                }
            });

            const tindakanToString = (status) => {
                console.log(status);
                switch (status) {
                    case {{ DITERIMA }}:
                        return "Arsip";
                    case {{ REVISI }}:
                        return "Revisi";
                    case {{ ARSIP }}:
                        return "Arsip";
                }
            }

            const tindakanToBadge = (status) => {
                switch (status) {
                    case {{ DITERIMA }}:
                        return "success";
                    case {{ REVISI }}:
                        return "warning";
                    case {{ ARSIP }}:
                        return "success";
                }
            }

            // When the delete button in the modal is clicked, send an AJAX request to delete the operator
            $('#confirmDeleteSuratMasukBtn').on('click', function() {

                if (suratId) {
                    $.ajax({
                        type: 'POST',
                        url: `/suratmasuk/${suratId}`, // Replace with the actual delete route URL
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#deleteModalSuratMasuk').modal('hide');
                            window.location.href = "{{ route('suratmasuk.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting Surat Masuk:', error);
                            $('#deleteModalSuratMasuk').modal('hide');
                        }
                    });
                }
            });

            // When the delete button in the table is clicked, store the operator ID to be deleted
            $('.btn-delete').on('click', function() {
                suratId = $(this).data('id');
            });


            //Handle Create Form Submit
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
                        window.location.href = '{{ route('suratmasuk.index') }}';
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

            //Handle Edit Surat
            $('.btn-edit').click(function(e) {
                suratId = $(this).data('id');

                const url = '{{ route('suratmasuk.edit', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#editNomorSurat').val(response.surat.nomor_surat);
                        $('#editTanggalSurat').val(response.surat.tanggal_surat);
                        $('#editAlamatSurat').val(response.surat.asal_surat);
                        $('#editPerihal').val(response.surat.perihal);
                        $('#editLampiran').val(response.surat.lampiran);
                        $('#editJenis').val(response.surat.jenis);
                        $('#editSifat').val(response.surat.sifat);
                        $('#editTanggalMasuk').val(response.surat.tanggal_masuk);
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

                const url = '{{ route('suratmasuk.update', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratmasuk.index') }}';
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

            //Handle Edit Tindakan
            $('.btn-edit-tindakan').click(function(e) {
                suratId = $(this).data('id');
            });

            $('#editTindakanSubmitBtn').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#editTindakanForm');
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
                        window.location.href = '{{ route('suratmasuk.index') }}';
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

            $('.btn-detail').on('click', function(event) {

                $('.pdfContainer').hide();

                suratId = $(this).data('id');

                $.get(`suratmasuk/${suratId}`, function(data) {
                    $('.id').html(data.data.id);
                    $('.nomor_surat').html(data.data.nomor_surat);
                    $('.tanggal_surat').html(data.data.tanggal_surat);
                    $('.asal_surat').html(data.data.asal_surat);
                    $('.tanggal_masuk').html(data.data.tanggal_masuk);
                    $('.perihal').html(data.data.perihal);
                    $('.sifat').html(data.data.sifat);
                    $('.tindakan').text(tindakanToString(data.data.tindakan));
                    $('.tindakan').addClass(`badge-${tindakanToBadge(data.data.tindakan)}`)
                    $('.lampiran').html(data.data.lampiran);
                    $('.jenis').html(data.data.jenis);
                    $('.catatanKadis').html(data.data.disposisi != null ? data.data.disposisi
                        .catatan :
                        "-");
                    $('.catatan').html(data.data.catatan ?? "-");
                    $('.tingkat_keamanan').html(data.data.tingkat_keamanan);
                    $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
                        .replace(':file', data.data.file))
                })
            });

            $('#btn-ajukan-submit').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#ajukanForm');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratmasuk.updateTindakan', ':suratId') }}'.replace(':suratId',
                    suratId);
                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratmasuk.index') }}';
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

            $('.btn-ajukan').on('click', function() {
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
                        $('.lampiran').html(data.data.lampiran);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.perihal').html(data.data.perihal);
                        $('.jenis').html(data.data.jenis);
                        $('.sifat').html(data.data.sifat);
                        $('.tingkat_keamanan').html(data.data.tingkat_keamanan);
                        $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
                            ':file', data.data.file))
                        $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
                            .replace(':file', data.data.file))
                    },
                });
            })


            // tryyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy

            $('.btn-submit-bidang').on('click', function(event) {
                const form = $('#tindakanBidangForm');
                const formData = new FormData(form[0]);

                formData.append('id_surat', suratId);

                $.ajax({
                    url: '{{ route('disposisi.store') }}',
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (suratId) {
                            $.ajax({
                                type: 'POST',
                                url: `suratmasuk/${suratId}/tindakan`,
                                data: {
                                    _method: 'PUT',
                                    _token: '{{ csrf_token() }}',
                                    tindakan: 4,
                                },
                                success: function(response) {
                                    window.location.href =
                                        "{{ route('disposisi.index') }}";
                                },
                            });
                        }
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
                            console.log(error)
                            alert('Terjadi kesalahan pada server!');
                        }
                    }
                });
            });

            $('.btn-bidang').on('click', function() {
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
                        $('.tingkat_keamanan').html(data.data.tingkat_keamanan);
                        $('.sifat').html(data.data.sifat);
                        $('.lampiran').html(data.data.lampiran);
                        $('.perihal').html(data.data.perihal);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.jenis').html(data.data.jenis);
                        $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
                            ':file', data.data.file))
                        $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
                            .replace(':file', data.data.file))
                    },
                });

                $.ajax({
                    type: 'GET',
                    url: `bidang/all`,
                    success: function(data) {
                        const bidang = data.bidang
                        const selectElement = $('.bidang');

                        selectElement.empty();

                        // Populate the select element with options
                        bidang.forEach(function(item) {
                            if (item.id !== 2 && item.id !== 3) {
                                selectElement.append($('<option>', {
                                    value: item.id,
                                    text: item.bidang
                                }));
                            }
                        });
                    },
                });
            })

              $('.btn-disposisi').on('click', function() {
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
                        $('.lampiran').html(data.data.lampiran);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.perihal').html(data.data.perihal);
                        $('.jenis').html(data.data.jenis);
                        $('.sifat').html(data.data.sifat);
                        $('.tingkat_keamanan').html(data.data.tingkat_keamanan);
                        $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
                            ':file', data.data.file))
                        $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
                            .replace(':file', data.data.file))
                    },
                });
            })

            $('#btn-disposisi-submit').on('click', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const form = $('#disposisiKepalaForm');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratmasuk.updateTindakan', ':suratId') }}'.replace(':suratId',
                    suratId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '{{ route('suratmasuk.index') }}';
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
        });
    </script>
@stop
