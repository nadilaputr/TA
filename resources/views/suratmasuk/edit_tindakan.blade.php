<x-adminlte-modal id="editTindakanModal" title="Edit Surat Masuk" theme="info" icon="fa fa-md fa-fw fa-info-circle "
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
                        <option value="{{ TERUSKAN }}">Diteruskan</option>
                    </x-adminlte-select>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-success" id="editTindakanSubmitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-adminlte-modal>
