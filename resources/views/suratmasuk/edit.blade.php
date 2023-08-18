<x-adminlte-modal id="editModal" title="Edit Surat Masuk" theme="info"
                  icon="fa fa-md fa-fw fa-info-circle " size='lg' disable-animations v-centered static-backdrop
                  scrollable>

    <div class="card card-info">

        <div class="card-body">
            <form id="editForm" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editNomorSurat">Nomor Surat</label>
                            <input id="editNomorSurat" type="text" class="form-control" placeholder="Nomor Surat"
                                   name="nomor_surat">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="editTanggalSurat">Tanggal Surat</label>
                            <input id="editTanggalSurat" type="date" class="form-control" name="tanggal_surat" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="editAlamatSurat">Asal Surat</label>
                            <input id="editAlamatSurat" type="text" name="asal_surat"
                                   class="form-control" placeholder="Alamat Surat">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="editPerihal">Perihal</label>
                            <input id="editPerihal" type="text" name="perihal"
                                   class="form-control"
                                   placeholder="Perihal" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lampiran</label>
                            <x-adminlte-select id="editLampiran" name="lampiran">
                                <option value="1">1 Lembar</option>
                                <option value="2">2 Lembar</option>
                                <option value="3">3 Lembar</option>
                                <option value="4">4 Lembar</option>
                                <option value="5">5 Lembar</option>
                            </x-adminlte-select>
                        </div>

                        <div class="form-group">
                            <label>Jenis Surat</label>
                            <x-adminlte-select id="editJenis" name="jenis">
                                <option value="asli">Asli</option>
                                <option value="tembusan">Tembusan</option>
                            </x-adminlte-select>
                        </div>

                        <div class="form-group">
                            <label>Sifat</label>
                            <x-adminlte-select id="editSifat" name="sifat">
                                <option value="biasa">Biasa</option>
                                <option value="segera">Segera</option>
                                <option value="sangat_segera">Sangat Segera</option>
                            </x-adminlte-select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <x-adminlte-input-file id="editFile" name="file" igroup-size="md"
                                                   placeholder="Choose a file...">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                        </div>
                    </div>

                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-secondary" label="Close" data-dismiss="modal"/>
                    <button type="button" class="btn btn-success" id="editSubmitBtn">Submit</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
