<x-adminlte-modal id="createModalKeluar" title="ARSIP SURAT KELUAR" theme="white" icon="fa fa-md fa-fw fa-file-upload" size='lg'
    disable-animations v-centered scrollable>

    <div class="card card-info">

        <form id="createForm" action="{{ route('suratkeluar.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="card-body">
                <b>
                    <p class="text-lightblue">INFORMASI SURAT</p>
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
                            <label for="alamat_surat">Alamat Penerima</label>
                            <input id="alamat_surat" type="text" name="alamat_surat" class="form-control"
                                placeholder="Alamat Penerima" required>
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
                            <label for="perihal">Perihal</label>
                            <input id="perihal" type="text" class="form-control" name="perihal" placeholder="Perihal Surat"
                                value="{{ old('perihal') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <x-adminlte-select id="lampiran" name="lampiran" required>
                                <option selected disabled>Pilih Lampiran</option>
                                <option value="0 Lampiran">0 Lampiran</option>
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bidang">Dari Bidang</label>
                            <select class="form-control" name="id_bidang" required>
                                <option selected disabled>Pilih Bidang</option>
                                @foreach ($bidang as $row)
                                    <option value="{{ $row->id }}">{{ $row->bidang }}</option>
                                @endforeach
                            </select>
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
                <x-adminlte-button class="bg-danger text-white" label="Tutup" data-dismiss="modal" />
                <button type="button" class="btn btn-success" id="createSubmitBtn">Simpan</button>
            </x-slot>
        </form>
    </div>
</x-adminlte-modal>
