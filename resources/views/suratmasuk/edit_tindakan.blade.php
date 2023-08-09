<x-adminlte-modal id="editTindakan{{ $row->id }}" title="Edit Surat Masuk" theme="info" icon="fa fa-md fa-fw fa-info-circle "
    size='lg' disable-animations v-centered static-backdrop scrollable>

    <div class="card card-info">

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="card-body">
        
        <form action="{{ route('masuk.updateTindakan', $row->id) }}" method="POST" >
            @csrf
            @method('PUT')

            

                <div class="form-group">
                    <label>Tindakan</label>
                    <x-adminlte-select id="tindakan" class="form-control" name="tindakan">
                        <option selected>Pilih Tindakan</option>
                        <option value="teruskan">Diteruskan</option>
                        <option value="tidak-teruskan">Tidak Diteruskann</option>
                    </x-adminlte-select>
                </div>
            
            </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                {{-- <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </div> --}}
            </form>
    </div>

</x-adminlte-modal>


{{-- <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-edit').on('click', function(event) {

            var id = $(this).data('id');

            $.get(`suratmasuk/${id}`, function(surat) {
                $('#id').val(surat.id);
                $('#nomor_surat').val(surat.nomor_surat);
                $('#tanggal_surat').val(surat.tanggal_surat);
                $('#alamat_surat').val(surat.asal_surat);
                $('#tanggal_masuk').val(surat.tanggal_diterima);
                $('#perihal').val(surat.perihal);
                $('#status').val(surat.status);
                $('#lampiran').val(surat.lampiran);
                $('#tindakan').val(surat.tindakan);
                $('#sifat').val(surat.sifat);
                // Note: File input can't be set directly due to security reasons
            })
        });
    })
</script> --}}

