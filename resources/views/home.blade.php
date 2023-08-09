@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content')
    <br>
    <h3>Dashboard</h3>
    <p>Selamat datang, Admin</p>

    {{-- notifikasi box --}}
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
                        <td>{{ $row->nomor_surat }}</td>
                        <td>{{ $row->tanggal_surat }}</td>
                        <td>{{ $row->asal_surat }}</td>
                        <td>{{ $row->perihal }}</td>
                        <td>{{ $row->tanggal_masuk }}</td>
                        <td>{{ $row->tindakan  }}</td>
                        <td>{{ $row->status }}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#edit" data-id="{{ $row->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>

                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    <x-adminlte-modal id="edit" title="Edit Surat Masuk" theme="info" icon="fa fa-md fa-fw fa-info-circle "
        size='lg' disable-animations v-centered static-backdrop scrollable>
        <div class="card">
            <div class="card-body">
                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah Catatan" id="catatan" />
                </div>

                <div class="form-group">
                    <label>Tindakan</label>
                    <x-adminlte-select id="tindakan" class="form-control" name="tindakan">
                        <option selected disabled>Pilih Tindakan</option>
                        <option value="tindak-lanjut">Ajukan ke Kepala Dinas</option>
                        <option value="tidak-teruskan">Koreksi Kembali</option>
                    </x-adminlte-select>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success btn-update">Submit</button>
                </div>
            </div>
        </div>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            let suratId

            if ($("#tindakan").val() === "tidak-teruskan") {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function() {
                var selectedOption = $(this).val();

                if (selectedOption === "tidak-teruskan") {
                    $('#catatanContainer').show();
                } else {
                    $('#catatanContainer').hide();
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-update').on('click', function(event) {

                console.log(suratId);
                if (suratId) {
                    $.ajax({
                        type: 'POST',
                        url: `surat/masuk/${suratId}/tindakan`,
                        data: {
                            _method: 'PUT',
                            _token: '{{ csrf_token() }}',
                            tindakan: $('#tindakan').val(),
                            catatan: $('#catatan').val(),
                        },
                        success: function(response) {
                            window.location.href = "{{ route('home') }}"
                        },
                    })

                }
            });

            $('.btn-edit').on('click', function() {
                suratId = $(this).data('id')
            })
        })
    </script>
@stop
