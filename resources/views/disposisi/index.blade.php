@extends('adminlte::page')

@section('title', 'Disposisi')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content')
    <h1>Disposisi</h1>


    <div class="container-fluid mt-5">
        <x-adminlte-datatable id="table7" :heads="$heads" head-theme="info" striped hoverable with-buttons>

            @foreach ($disposisi as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->tanggal_disposisi }}</td>
                    <td>{{ $row->diteruskan_kepada }}</td>
                    <td>{{ $row->perihal }}</td>
                    <td>{{ $row->catatan }}</td>
                    <td>{{ $row->status }}</td>                    <td>
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
                        <option value="2" selected disabled>Pilih Tindakan</option>
                        <option value="1">Ajukan ke Kepala Dinas</option>
                        <option value="0">Koreksi Kembali</option>
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

            if ($("#tindakan").val() === "0") {
                $('#catatanContainer').show();
            } else {
                $('#catatanContainer').hide();
            }

            $("#tindakan").change(function() {
                var selectedOption = $(this).val();

                if (selectedOption === "0") {
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

