@extends('adminlte::page')
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@section('title', 'Data Operator')

@section('content_header')
    <h1>Data Operator</h1>
@stop

@section('content')
    @role('admin')
        @if ($register_url)
            <a href="/register">
                <button class="btn btn-info btn-create mb-3">Tambah</button>
            </a>
        @endif
        <x-adminlte-datatable id="table5" :heads="$heads" striped hoverable>
            @foreach ($dataOperator as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->jabatan }}</td>
                    <td>{{ $row->bidang->bidang }}</td>
                    <td>{{ strtoupper($row->getRoleNames()->first()) }}</td>
                    <td class="d-flex">

                        <a href="{{ route('dataoperator.edit', $row->id) }}"
                            class="btn btn-xs btn-default text-info mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <a href="{{ route('dataoperator.password', $row->id) }}"
                            class="btn btn-xs btn-default text-info mx-1 shadow" title="Ubah Password">
                            <i class="fa fa-lg fa-fw fa-lock"></i>
                        </a>
                        <a href="{{ route('dataoperator.role', $row->id) }}"
                            class="btn btn-xs btn-default text-info mx-1 shadow" title="Ubah Role">
                            <i class="fa fa-lg fa-fw fa-user-shield"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#deleteModalOperator"
                            data-id="{{ $row->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete"
                            title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>

                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    @else
        <x-adminlte-alert theme="danger" title="Tidak Dapat Mengakses">
            Halaman ini hanya dapat diakses oleh Admin!
        </x-adminlte-alert>
    @endrole

    <x-adminlte-modal id="deleteModalOperator" title="Hapus Akun" size="md" theme="white"
        icon="fa fa-sm fa-fw fa-trash" v-centered scrollable>
        <div>Anda yakin ingin menghapus operator ?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="secondary" label="Batal" data-dismiss="modal" />
            <x-adminlte-button theme="danger" label="Hapus" id="confirmDeleteOperatorBtn" />
        </x-slot>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Store the operator ID to be deleted when the delete button is clicked
            let operatorIdToDelete;

            // When the delete button in the modal is clicked, send an AJAX request to delete the operator
            $('#confirmDeleteOperatorBtn').on('click', function() {

                if (operatorIdToDelete) {
                    $.ajax({
                        type: 'POST',
                        url: `/dataoperator/${operatorIdToDelete}`, // Replace with the actual delete route URL
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#deleteModalOperator').modal('hide');
                            window.location.href = "{{ route('dataoperator.index') }}";
                        },
                        error: function(error) {
                            console.error('Error deleting operator:', error);
                            $('#deleteModalOperator').modal('hide');
                        }
                    });
                }
            });

            // When the delete button in the table is clicked, store the operator ID to be deleted
            $('.btn-delete').on('click', function() {
                operatorIdToDelete = $(this).data('id');
            });
        });
    </script>
@stop
