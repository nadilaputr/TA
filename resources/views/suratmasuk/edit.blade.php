<x-adminlte-modal id="editModal" title="EDIT SURAT MASUK" theme="white" icon="fa fa-md fa-fw fa-pen" size='lg'
    disable-animations v-centered scrollable>

    <div class="card card-info">

        <div class="card-body">
            <form id="editForm" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <b>
                    <p class="text-lightblue">INFORMASI UMUM</p>
                </b>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editNomorSurat">Nomor Surat</label>
                            <input id="editNomorSurat" type="text" class="form-control" placeholder="Nomor Surat"
                                name="nomor_surat">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="editAlamatSurat">Asal Surat</label>
                            <input id="editAlamatSurat" type="text" name="asal_surat" class="form-control"
                                placeholder="Alamat Surat">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editTanggalSurat">Tanggal Surat</label>
                            <input id="editTanggalSurat" type="date" class="form-control" name="tanggal_surat"
                                required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="editTanggalMasuk">Tanggal Diterima</label>
                            <input id="editTanggalMasuk" type="datetime-local" class="form-control" name="tanggal_masuk" disabled
                                value="{{ old('tanggal_masuk') }}">
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="editPerihal">Perihal</label>
                    <input id="editPerihal" type="text" name="perihal" class="form-control" placeholder="Perihal"
                        required>
                    <div class="invalid-feedback"></div>
                </div>

                <b>
                    <p class="text-lightblue">INFORMASI TAMBAHAN</p>
                </b>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="editJenis">Jenis Surat</label>
                            <input id="editJenis" type="text" name="jenis" class="form-control"
                                placeholder="Jenis Surat">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Lampiran</label>
                                <x-adminlte-select id="editLampiran" name="lampiran">
                                    <option selected disabled>Pilih Lampiran</option>
                                    <option value="1 Lampiran">1 Lampiran</option>
                                    <option value="2 Lampiran">2 Lampiran</option>
                                    <option value="3 Lampiran">3 Lampiran</option>
                                    <option value="4 Lampiran">4 Lampiran</option>
                                    <option value="5 Lampiran">5 Lampiran</option>
                                </x-adminlte-select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sifat</label>
                            <x-adminlte-select id="editSifat" name="sifat">
                                <option value="Biasa">Biasa</option>
                                <option value="Segera">Segera</option>
                                <option value="Sangat Segera">Sangat Segera</option>
                            </x-adminlte-select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tkt. Keamanan</label>
                            <x-adminlte-select id="editTingkatKeamanan" name="tingkat_keamanan">
                                <option value="Biasa">Biasa</option>
                                <option value="Segera">Segera</option>
                                <option value="Sangat Segera">Sangat Segera</option>
                            </x-adminlte-select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    </div>

                    <b>
                        <p class="text-lightblue">UPLOAD FILE</p>
                    </b>
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
                        <small class="text-danger">*file jpg, jpeg, pdf, png.</small>
                    </div>
                </div>

                    <x-slot name="footerSlot">
                        <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" />
                        <button type="button" class="btn btn-success" id="editSubmitBtn">Submit</button>
                    </x-slot>
            </form>
    </div>
</x-adminlte-modal>
