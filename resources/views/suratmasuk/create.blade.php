    @php
        $config = ['format' => 'L'];
    @endphp

<x-adminlte-modal id="tambah_surat_masuk" title="Tambah Surat Masuk" theme="info" icon="fa fa-md fa-fw fa-info-circle " size='lg'
disable-animations>

    <div class="card card-info">
        



        <form action="{{ route('masuk.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input id="nomor_surat" type="text" class="form-control" placeholder="Nomor Surat" name="nomor_surat" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input id="tanggal_surat" type="date" class="form-control" name="tanggal_surat" required
                        value="{{ old('tanggal_surat') }}">
                </div>

                <div class="form-group">
                    <label>Alamat Surat</label>
                    <input id="alamat_surat" type="text" name="alamat_surat" class="form-control" placeholder="Alamat Surat" required>
                </div>

                <div class="form-group">
                    <label>File</label>
                    <x-adminlte-input-file id="file" name="file" igroup-size="md" placeholder="Choose a file...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>

                <div class="form-group">
                    <label>Perihal</label>
                    <input id="perihal" type="text" name="perihal" class="form-control" placeholder="Perihal" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <x-adminlte-select  id="status" name="status">
                        <option value="0">Belum Disposisi</option>
                        <option value="1">Sudah Disposisi</option>
                    </x-adminlte-select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</x-adminlte-modal>

