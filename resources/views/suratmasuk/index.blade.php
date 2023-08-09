@can('view surat', Post::class)

    @extends('adminlte::page')

    @section('title', 'Surat Masuk')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.BsCustomFileInput', true)

@section('content')
    <h3>Surat Masuk</h3>

    <a class="btn btn-info tambah-surat-masuk mb-3 btn-tambah btn-edit" href="{{ route('masuk.create') }}"data-toggle="modal"
        data-target="#tambah_surat_masuk">Tambah</a>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Tabel Surat Masuk --}}
    <x-adminlte-datatable id="table7" :heads="$heads" head-theme="info" striped hoverable with-buttons>

        @foreach ($surat as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $row->tanggal_surat }}</td>
                <td>{{ $row->asal_surat }}</td>
                <td>{{ $row->tanggal_masuk }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->jenis }}</td>
                <td>{{ $row->catatan }}</td>
                <form action="{{ route('masuk.destroy', $row->id) }}" method="POST">
                    <td class="d-flex">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>

                        <button type="button" data-toggle="modal" data-target="#edit_surat_masuk{{ $row->id }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>

                        <button type="button" data-toggle="modal" data-target="#modalPurple" data-id="{{ $row->id }}"
                            class="btn btn-xs btn-default btn-detail text-success mx-1 shadow" title="Detail">
                            <i class="fa fa-lg fa-fw fa-info-circle"></i>
                        </button>

                        <a href="{{ Storage::url($row->file) }}" target="_blank"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                            <i class="fa fa-lg fa-fw fa-file"></i>
                        </a>

                        <button type="button" data-toggle="modal" data-target="#editTindakan{{ $row->id }}"
                            class="btn btn-xs btn-default btn-edit text-success mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </td>
                </form>
            </tr>
            @include('suratmasuk.edit')
            @include('suratmasuk.edit_tindakan')
        @endforeach
    </x-adminlte-datatable>
    {{-- End Tabel Surat Masuk --}}

    {{-- Modal Detail Surat Masuk --}}
    <x-adminlte-modal id="modalPurple" title="Detail" theme="info" icon="fa fa-md fa-fw fa-info-circle " size='lg'
        disable-animations v-centered static-backdrop scrollable>
        <table class="table">
            <tbody>
                <tr>
                    <th>No</th>
                    <td id="id"></td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td id="nomor_surat"></td>
                </tr>
                <tr>
                    <th>Tanggal Surat</th>
                    <td id="tanggal_surat"></td>
                </tr>
                <tr>
                    <th>Asal Surat</th>
                    <td id="asal_surat"></td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td id="tanggal_masuk"></td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td id="perihal"></td>
                </tr>
                <tr>
                    <th>Lampiran</th>
                    <td id="lampiran"></td>
                </tr>
                <tr>
                    <th>Sifat</th>
                    <td id="sifat"></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td id="status"></td>
                </tr>
                <tr>
                    <th>File</th>
                    <td id="file"></td>
                </tr>
                <tr>
                    <th>Tindakan</th>
                    <td id="tindakan"></td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td id="catatan"></td>
                </tr>
            </tbody>
        </table>
    </x-adminlte-modal>
    {{-- End Modal Detail Surat Masuk --}}

    @include('suratmasuk.create')
@stop

{{-- Javascript Modal --}}
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-detail').on('click', function(event) {

                var id = $(this).data('id');

                $.get(`masuk/${id}`, function(data) {
                    $('#id').html(data.data.id);
                    $('#nomor_surat').html(data.data.nomor_surat);
                    $('#tanggal_surat').html(data.data.tanggal_surat);
                    $('#asal_surat').html(data.data.asal_surat);
                    $('#tanggal_masuk').html(data.data.tanggal_masuk);
                    $('#perihal').html(data.data.perihal);
                    $('#status').html(data.data.status);
                    $('#sifat').html(data.data.sifat);
                    $('#file').html(data.data.file);
                    $('#tindakan').html(data.data.tindakan);
                    $('#catatan').html(data.data.catatan);
                    $('#lampiran').html(data.data.lampiran);
                })
            });
            
        })
    </script>

@stop
{{-- End Javascript Modal --}}

@endcan
