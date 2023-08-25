<x-adminlte-modal id="createModal" title="TAMBAH SURAT MASUK" theme="white" icon="fa fa-md fa-fw fa-file-upload" size='lg'
    disable-animations v-centered scrollable>

    <div class="card card-info">

        <form id="createForm" action="{{ route('suratmasuk.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="card-body">
                <b>
                    <p class="text-lightblue">INFORMASI UMUM</p>
                </b>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input id="nomor_surat" type="text" class="form-control" placeholder="Nomor Surat"
                                name="nomor_surat" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_surat">Asal Surat</label>
                            <input id="alamat_surat" type="text" name="asal_surat" class="form-control"
                                placeholder="Asal Surat" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_surat">Tanggal Surat</label>
                            <input id="tanggal_surat" type="date" class="form-control" name="tanggal_surat" required
                                value="{{ old('tanggal_surat') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                   

                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input id="tanggal_masuk" type="date" class="form-control" name="tanggal_masuk" disabled
                                value="{{ old('tanggal_masuk') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="perihal">Perihal</label>
                    <input id="perihal" type="text" name="perihal" class="form-control" placeholder="Perihal"
                        required>
                    <div class="invalid-feedback"></div>
                </div>

                <b>
                    <p class="text-lightblue">INFORMASI TAMBAHAN</p>
                </b>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis">Jenis Surat</label>
                            <x-adminlte-select id="jenis" name="jenis" required>
                                <option selected disabled>Pilih Jenis Surat</option>
                                <option value="Asli">Asli</option>
                                <option value="Tembusan">Tembusan</option>
                            </x-adminlte-select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <x-adminlte-select id="lampiran" name="lampiran" required>
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
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sifat">Sifat</label>
                            <x-adminlte-select id="sifat" name="sifat" required>
                                <option selected disabled>Pilih Sifat</option>
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
                    <x-adminlte-input-file id="file" name="file" igroup-size="md" placeholder="Choose a file..."
                        required error-key="file">
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
                <x-adminlte-button class="btn-secondary" label="Close" data-dismiss="modal" />
                <button type="button" class="btn btn-success" id="createSubmitBtn">Submit</button>
            </x-slot>
        </form>
    </div>
</x-adminlte-modal>
