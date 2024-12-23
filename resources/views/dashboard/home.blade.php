@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@php
    $config['order'] = [];
@endphp

@section('content')
    @if (Auth::check())
        <h3 class="mt-3">Selamat datang, {{ Auth::user()->name }}</h1>
    @endif

    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlahSuratMasuk }}</h3>
                    <p>Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/suratmasuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlahSuratKeluar }}</sup></h3>
                    <p>Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/suratkeluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlahDisposisi }}</h3>
                    <p>Disposisi Surat</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/disposisi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlahUser }}</h3>
                    <p>Operator</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/dataoperator" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <x-adminlte-datatable id="table7" :heads="$heads" :config="$config" head-theme="info" striped hoverable
                with-buttons>

                @foreach ($suratMasuk as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->nomor_surat }}</td>
                        <td>{{ $dateFormat->from($row->tanggal_masuk) }}</td>
                        <td>{{ $row->asal_surat }}</td>
                        <td>{{ $row->perihal }}</td>
                        <td>{{ $row->disposisi->bidang->bidang ?? 'Tidak Diketahui' }}</td>
                        <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td>
                        <td>
                            @role('kepaladinas')
                            @if ($row->tindakan == MENUNGGU_INSTRUKSI_KEPALA)
                                <button type="button" data-toggle="modal" data-target="#disposisiKepalaModal"
                                    data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-info mx-1 shadow btn-disposisi" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            @endif
                            @endrole
                            @unlessrole('sekretaris|kepaladinas|admin')
                                <button type="button" data-toggle="modal" data-target="#terimaModal"
                                    data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-info mx-1 shadow btn-terima-tindakan"
                                    title="Terima Disposisi">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>    
                            @endunlessrole
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    @include('dashboard.disposisi_kepala_modal')
    @include('dashboard.tindakan_bidang_modal')
    @include('disposisi.terima')
@stop

@push('js')
    <script>
        $(document).ready(function() {

            let suratId;

            // if ($("#tindakan").val() === "1") {
            //     $('#catatanContainer').show();
            // } else {
            //     $('#catatanContainer').hide();
            // }

            // $("#tindakan").change(function() {
            //     var selectedOption = $(this).val();

            //     if (selectedOption === "1") {
            //         $('#catatanContainer').show();
            //     } else {
            //         $('#catatanContainer').hide();
            //     }
            // });

            $('.btn-terima-tindakan').on('click', function() {
                suratId = $(this).data('id');

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
                        $('.lampiran').html(data.data.lampiran);
                        $('.sifat').html(data.data.disposisi != null ? data.data.disposisi
                        .sifat : "-");
                        $('.catatan').html(data.data.disposisi != null ? data.data.disposisi
                            .catatan : "-");
                        $('.bidang').html(data.data.bidang);
                        $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
                            ':file', data.data.file))
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
                        window.location.href = '{{ route('home') }}';
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

            // $('#btn-disposisi-submit').on('click', function(e) {
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });

            //     const form = $('#disposisiKepalaForm');
            //     const formData = new FormData(form[0]);

            //     const url = '{{ route('suratmasuk.updateTindakan', ':suratId') }}'.replace(':suratId',
            //         suratId);

            //     $.ajax({
            //         url: url,
            //         type: form.attr('method'),
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function(response) {
            //             window.location.href = '{{ route('suratmasuk.index') }}';
            //         },
            //         error: function(xhr, status, error) {
            //             if (xhr.status === 422) {
            //                 const errors = JSON.parse(xhr.responseText)

            //                 // Clear previous error messages
            //                 $('.invalid-feedback').empty();
            //                 $('.is-invalid').removeClass('is-invalid');

            //                 // Iterate through each error and display next to the input
            //                 $.each(errors, function(field, messages) {
            //                     const input = $('[name="' + field + '"]');
            //                     const errorContainer = input.siblings(
            //                         '.invalid-feedback');
            //                     errorContainer.text(messages[0]);
            //                     input.addClass('is-invalid');
            //                 });
            //             } else {
            //                 alert('Terjadi kesalahan pada server!');
            //             }
            //         }
            //     });
            // });

            // $('.btn-submit-bidang').on('click', function(event) {
            //     const form = $('#tindakanBidangForm');
            //     const formData = new FormData(form[0]);

            //     formData.append('id_surat', suratId);

            //     $.ajax({
            //         url: '{{ route('disposisi.store') }}',
            //         type: form.attr('method'),
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function(response) {
            //             if (suratId) {
            //                 $.ajax({
            //                     type: 'POST',
            //                     url: `suratmasuk/${suratId}/tindakan`,
            //                     data: {
            //                         _method: 'PUT',
            //                         _token: '{{ csrf_token() }}',
            //                         tindakan: 4,
            //                     },
            //                     success: function(response) {
            //                         window.location.href =
            //                             "{{ route('disposisi.index') }}";
            //                     },
            //                 });
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             if (xhr.status === 422) {
            //                 const errors = JSON.parse(xhr.responseText)

            //                 // Clear previous error messages
            //                 $('.invalid-feedback').empty();
            //                 $('.is-invalid').removeClass('is-invalid');

            //                 // Iterate through each error and display next to the input
            //                 $.each(errors, function(field, messages) {
            //                     const input = $('[name="' + field + '"]');
            //                     const errorContainer = input.siblings(
            //                         '.invalid-feedback');
            //                     errorContainer.text(messages[0]);
            //                     input.addClass('is-invalid');
            //                 });
            //             } else {
            //                 console.log(error)
            //                 alert('Terjadi kesalahan pada server!');
            //             }
            //         }
            //     });
            // });


            // $('.btn-disposisi').on('click', function() {
            //     suratId = $(this).data('id')

            //     $('.pdfContainer').hide();

            //     const url = '{{ route('suratmasuk.show', ':suratId') }}'.replace(':suratId', suratId);

            //     $.ajax({
            //         type: 'GET',
            //         url: url,
            //         success: function(data) {
            //             $('.id').html(data.data.id);
            //             $('.nomor_surat').html(data.data.nomor_surat);
            //             $('.tanggal_surat').html(data.data.tanggal_surat);
            //             $('.asal_surat').html(data.data.asal_surat);
            //             $('.lampiran').html(data.data.lampiran);
            //             $('.tanggal_masuk').html(data.data.tanggal_masuk);
            //             $('.perihal').html(data.data.perihal);
            //             $('.jenis').html(data.data.jenis);
            //             $('.sifat').html(data.data.sifat);
            //             $('.tingkat_keamanan').html(data.data.tingkat_keamanan);
            //             $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
            //                 ':file', data.data.file))
            //             $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
            //                 .replace(':file', data.data.file))
            //         },
            //     });
            // })

            // $('.btn-bidang').on('click', function() {
            //     suratId = $(this).data('id')

            //     $('.pdfContainer').hide();

            //     const url = '{{ route('suratmasuk.show', ':suratId') }}'.replace(':suratId', suratId);

            //     $.ajax({
            //         type: 'GET',
            //         url: url,
            //         success: function(data) {
            //             $('.id').html(data.data.id);
            //             $('.nomor_surat').html(data.data.nomor_surat);
            //             $('.tanggal_surat').html(data.data.tanggal_surat);
            //             $('.asal_surat').html(data.data.asal_surat);
            //             $('.tingkat_keamanan').html(data.data.tingkat_keamanan);
            //             $('.sifat').html(data.data.sifat);
            //             $('.lampiran').html(data.data.lampiran);
            //             $('.perihal').html(data.data.perihal);
            //             $('.tanggal_masuk').html(data.data.tanggal_masuk);
            //             $('.jenis').html(data.data.jenis);
            //             $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
            //                 ':file', data.data.file))
            //             $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
            //                 .replace(':file', data.data.file))
            //         },
            //     });

            //     $.ajax({
            //         type: 'GET',
            //         url: `bidang/all`,
            //         success: function(data) {
            //             const bidang = data.bidang
            //             const selectElement = $('.bidang');

            //             selectElement.empty();

            //             // Populate the select element with options
            //             bidang.forEach(function(item) {
            //                 if (item.id !== 1 && item.id !== 2 && item.id !== 3) {
            //                     selectElement.append($('<option>', {
            //                         value: item.id,
            //                         text: item.bidang
            //                     }));
            //                 }
            //             });
            //         },
            //     });
            // })

            $('.btn-disposisi').on('click', function() {
                suratId = $(this).data('id')

                $('.pdfContainer').hide();

                const url = '{{ route('suratmasuk.show', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        console.log(data.data)
                        $('.id').html(data.data.id);
                        $('.nomor_surat').html(data.data.nomor_surat);
                        $('.tanggal_surat').html(data.data.tanggal_surat);
                        $('.asal_surat').html(data.data.asal_surat);
                        $('.lampiran').html(data.data.lampiran);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.perihal').html(data.data.perihal);
                        $('.jenis').html(data.data.jenis);
                        $('.sifat').html(data.data.disposisi.sifat);
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
                        window.location.href = '{{ route('home') }}';
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
@endpush
