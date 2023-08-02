@extends('adminlte::page')

@section('title', 'Bidang')

@section('content_header')
    <h1>Bidang</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)


@section('content')
    @role('admin')
    <a class="btn btn-info" href="{{ route('bidang.create') }}">Tambah</a>
        <x-adminlte-datatable id="table5" :heads="$heads">
            @foreach ($bidang as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->namabidang }}</td>
                    <td class="d-flex">

                        <a href="{{ route('bidang.edit', $row->id) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                      
                        <button type="button" data-toggle="modal" data-target="#deleteModal" data-id="{{ $row->id }}"
                            class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>

                        {{-- Kayaknya gk butuh button detail, karena data udah detail di tabel --}}
                        {{-- <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                                title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                                <i class="fa fa-lg fa-fw fa-info-circle"></i>
                            </button> --}}
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    @else
        <x-adminlte-alert theme="danger" title="Tidak Dapat Mengakses">
            Halaman ini hanya dapat diakses oleh Admin!
        </x-adminlte-alert>
    @endrole

    <x-adminlte-modal id="deleteModal" title="Hapus Akun" size="sm" theme="danger" icon="fas fa-trash" v-centered
        static-backdrop scrollable>
        <div>Anda yakin ingin menghapus operator ?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Batal" data-dismiss="modal" />
            <x-adminlte-button theme="danger" label="Hapus" id="confirmDeleteBtn" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Store the operator ID to be deleted when the delete button is clicked
            let bidangIdToDelete;

            // When the delete button in the modal is clicked, send an AJAX request to delete the bidang
            $('#confirmDeleteBtn').on('click', function() {

                if (bidangIdToDelete) {
                    $.ajax({
                        type: 'POST',
                        url: `/bidang/${bidangIdToDelete}`, // Replace with the actual delete route URL
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#deleteModal').modal('hide');
                            window.location.href = "{{ route('bidang.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting bidang:', error);
                            $('#deleteModal').modal('hide');
                        }
                    });
                }
            });

            // When the delete button in the table is clicked, store the bidang ID to be deleted
            $('.btn-delete').on('click', function() {
                bidangIdToDelete = $(this).data('id');
            });
        });
    </script>
@stop