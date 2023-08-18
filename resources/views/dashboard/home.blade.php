@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content')
    <h3 class="mt-3">Dashboard</h3>
    <p>Selamat datang, Admin</p>

    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <x-adminlte-datatable id="table7" :heads="$heads" head-theme="info" striped hoverable with-buttons>

                @foreach ($suratMasuk as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->asal_surat }}</td>
                        <td>{{ $row->perihal }}</td>
                        <td>{{ $row->tanggal_masuk }}</td>
                        <td>{!! $tindakanSurat->toBadge($row->tindakan) !!}</td>
                        <td>
                            @role('sekretaris')
                            <button type="button" data-toggle="modal" data-target="#ajukanModal"
                                    data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow btn-ajukan font-weight-bold"
                                    title="Edit">
                                <span>Ajukan</span>
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            @endrole
                            @role('kepaladinas')
                            <button type="button" data-toggle="modal" data-target="#bidangModal"
                                    data-id="{{ $row->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow btn-bidang" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
    @include('dashboard.ajukan_modal')
    @include('dashboard.tindakan_bidang_modal')
@stop

@section('js')
    <script>
        $(document).ready(function () {

            if ($("#tindakan").val() === "1") {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function () {
                var selectedOption = $(this).val();

                if (selectedOption === "1") {
                    $('#catatanContainer').show();
                } else {
                    $('#catatanContainer').hide();
                }
            });

            $('#btn-ajukan-submit').on('click', function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const suratId = $('.btn-ajukan').data('id');
                const form = $('#ajukanForm');
                const formData = new FormData(form[0]);

                const url = '{{ route('suratmasuk.updateTindakan', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        window.location.href = '{{ route('home') }}';
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            const errors = JSON.parse(xhr.responseText)

                            // Clear previous error messages
                            $('.invalid-feedback').empty();
                            $('.is-invalid').removeClass('is-invalid');

                            // Iterate through each error and display next to the input
                            $.each(errors, function (field, messages) {
                                const input = $('[name="' + field + '"]');
                                const errorContainer = input.siblings('.invalid-feedback');
                                errorContainer.text(messages[0]);
                                input.addClass('is-invalid');
                            });
                        } else {
                            alert('Terjadi kesalahan pada server!');
                        }
                    }
                });
            });

            $('.btn-submit-bidang').on('click', function (event) {
                const suratId = $('.btn-bidang').data('id');
                const form = $('#tindakanBidangForm');
                const formData = new FormData(form[0]);

                formData.append('id_surat', suratId);

                $.ajax({
                    url: '{{ route('disposisi.store') }}',
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (suratId) {
                            $.ajax({
                                type: 'POST',
                                url: `suratmasuk/${suratId}/tindakan`,
                                data: {
                                    _method: 'PUT',
                                    _token: '{{ csrf_token() }}',
                                    tindakan: 4,
                                },
                                success: function (response) {
                                    window.location.href =
                                        "{{ route('disposisi.index') }}";
                                },
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            const errors = JSON.parse(xhr.responseText)

                            // Clear previous error messages
                            $('.invalid-feedback').empty();
                            $('.is-invalid').removeClass('is-invalid');

                            // Iterate through each error and display next to the input
                            $.each(errors, function (field, messages) {
                                const input = $('[name="' + field + '"]');
                                const errorContainer = input.siblings('.invalid-feedback');
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

            $('.btn-ajukan').on('click', function () {
                const suratId = $(this).data('id')

                $('.pdfContainer').hide();

                const url = '{{ route('suratmasuk.show', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        $('.id').html(data.data.id);
                        $('.nomor_surat').html(data.data.nomor_surat);
                        $('.tanggal_surat').html(data.data.tanggal_surat);
                        $('.asal_surat').html(data.data.asal_surat);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.perihal').html(data.data.perihal);
                        $('.jenis').html(data.data.jenis);
                        $('.downloadFile').attr('href', '{{ Storage::url(':file') }}'.replace(':file', data.data.file))
                        $('.pdfViewerBtn').attr('data-url', '{{ Storage::url(':file') }}'.replace(':file', data.data.file))
                    },
                });
            })

            $('.btn-bidang').on('click', function () {
                const suratId = $(this).data('id')

                $('.pdfContainer').hide();

                const url = '{{ route('suratmasuk.show', ':suratId') }}'.replace(':suratId', suratId);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        $('.id').html(data.data.id);
                        $('.nomor_surat').html(data.data.nomor_surat);
                        $('.tanggal_surat').html(data.data.tanggal_surat);
                        $('.asal_surat').html(data.data.asal_surat);
                        $('.tanggal_masuk').html(data.data.tanggal_masuk);
                        $('.perihal').html(data.data.perihal);
                        $('.jenis').html(data.data.jenis);
                        $('.downloadFile').attr('href', '{{ Storage::url(':file') }}'.replace(':file', data.data.file))
                        $('.pdfViewerBtn').attr('data-url', '{{ Storage::url(':file') }}'.replace(':file', data.data.file))
                    },
                });

                $.ajax({
                    type: 'GET',
                    url: `bidang/all`,
                    success: function (data) {
                        const bidang = data.bidang
                        const selectElement = $('.bidang');

                        selectElement.empty();

                        // Populate the select element with options
                        bidang.forEach(function (item) {
                            selectElement.append($('<option>', {
                                value: item.id,
                                text: item.bidang
                            }));
                        });
                    },
                });
            })

            $('.pdfViewerBtn').click(function (e) {
                const url = $(this).data('url');

                $('.pdfViewer').attr('src', url);
                $('.pdfContainer').show();
            })
        })
    </script>
@stop
