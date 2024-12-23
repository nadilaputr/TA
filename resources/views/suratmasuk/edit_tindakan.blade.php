<x-adminlte-modal id="editTindakanModal" title="REVISI" theme="white" icon="fa fa-md fa-fw fa-info-circle "
    size='lg' disable-animations v-centered static-backdrop scrollable>

    <div class="card card-info">
        <div class="card-body">
            <form id="editTindakanForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tindakan</label>
                    <x-adminlte-select id="tindakan" class="form-control" name="tindakan" error-key="tindakan">
                        <option selected disabled>Pilih Tindakan</option>
                        <option value="{{ TELAH_DIREVISI }}">Ajukan Perbaikan</option>
                    </x-adminlte-select>
                </div>
                <div class="invalid-feedback"></div>
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button class="bg-danger text-white" label="Tutup" data-dismiss="modal" />
                <button type="button" class="btn btn-success" id="editTindakanSubmitBtn">Simpan</button>
            </x-slot>
        </div>
    </div>
</x-adminlte-modal>

@section('js')
@endsection