<x-adminlte-modal id="tambahdisposisi" title="Tambah Disposisi" theme="navy" icon="fas fa-solid fa-file-medical"
    size='lg' v-centered scrollable>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="bidang">
                        <option selected>Pilih Bidang</option>
                        @foreach ($bidang as $row)
                            @if ($row->id == 2)
                                <option value="{{ $row->id }}">{{ $row->bidang }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan" />
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-adminlte-modal>
