<x-adminlte-modal id="ajukanModal" title="Ajukan" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>


    <div class="col-md-6">
        <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="light">
            <table class="table table-sm table-hover">
                <td>Sifat</td>
                <td class="sifat"></td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis</td>
                    <td class="jenis"></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td class="lampiran"></td>
                </tr>
                <tr>
                    <td>Tanggal Diterima</td>
                    <td class="tanggal_masuk"></td>
                </tr>
            </table>
        </x-adminlte-card>
    </div>


    <x-adminlte-card id="detailsurat" title="INFORMASI DETAIL SURAT" theme="lightblue">
        <table class="table table-sm">
            <tr>
                <td>No Agenda</td>
                <td class="id"></td>
            </tr>
            <tr>
                <td>Nomor Surat</td>
                <td class="nomor_surat"></td>
            </tr>
            <tr>
                <td>Asal Surat</td>
                <td class="asal_surat"></td>
            </tr>
            <tr>
                <td>Perihal Surat</td>
                <td class="perihal"></td>
            </tr>
            <tr>
                <td>Tanggal Surat</td>
                <td class="tanggal_surat"></td>
            </tr>
            <tr>
                <td>File</td>
                <td class="d-flex">
                    {{-- <a target="_blank" class="btn btn-xs btn-default text-primary mx-1 shadow downloadFile"
                        title="Lihat File">Download
                        <i class="fa fa-lg fa-fw fa-file"></i>
                    </a> --}}
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn" title="Lihat File">View
                    </button>
                </td>
            </tr>
        </table>
    </x-adminlte-card>

    <div class="card">
        <div class="card-body">
            <div class="pdfContainer">
                <iframe class="pdfViewer" style="width: 100%; height: 500px;"></iframe>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body bg-light">
            <form id="ajukanForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="tindakan">Tindakan Surat</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih Tindakan</option>
                        <option value="{{ ARSIP }}">Arsip Surat</option>
                        <option value="{{ REVISI }}">Koreksi kembali</option>
                        <option value="{{ MENUNGGU_INSTRUKSI_KEPALA }}">Ajukan ke Kepala Dinas</option>
                    </select>
                </div>

                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan" />
                </div>
                <div id="informasi_tambahan">
                    <b>
                        <p class="text-lightblue">INFORMASI TAMBAHAN</p>
                    </b>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jenis">Jenis Surat</label>
                                <input id="jenis" type="text" name="jenis" class="form-control"
                                    placeholder="Jenis Surat" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
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

                        <div class="col-md-3">
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
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" />
                    <button id="btn-ajukan-submit" type="button" class="btn btn-primary update">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
