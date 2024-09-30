<x-adminlte-modal id="ajukanModal" title="Ajukan" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>

    <x-adminlte-card id="detailsurat" title="AGENDA" theme="light">
        <table class="table table-sm table-hover">
            <tr>
                <td>No</td>
                <td class="id"></td>
            </tr>
            <tr>
                <td>Tanggal Diterima</td>
                <td class="tanggal_masuk"></td>
            </tr>
        </table>
    </x-adminlte-card>

    <x-adminlte-card id="detailsurat" title="INFORMASI DETAIL SURAT" theme="lightblue">
        <table class="table table-sm">
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
                <td>Lampiran</td>
                <td class="lampiran"></td>
            </tr>
            <tr>
                <td>File</td>
                <td class="d-flex">
                    <a target="_blank" class="btn btn-xs btn-info text-white mx-1 shadow font-weight-bold downloadFile"
                        title="Lihat File">View
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>
                </td>
            </tr>
        </table>
    </x-adminlte-card>

    <div class="card">
        <div class="card-body bg-light">
            <form id="ajukanForm" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id_surat" id="id_surat_input">

                <div class="form-group">
                    <label for="tindakan">Tindakan Surat</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih Tindakan</option>
                        <option value="{{ ARSIP }}">Arsip Surat</option>
                        <option value="{{ REVISI }}">Koreksi kembali</option>
                        <option value="{{ MENUNGGU_INSTRUKSI_KEPALA }}">Ajukan Ke Kepala Dinas</option>
                    </select>
                </div>

                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan" />
                </div>

                <div id="informasi_tambahan">
                    <div class="form-group">
                        <label>Bidang</label>
                        <select class="form-control bidang" name="id_bidang" id="bidang" required>
                        </select>
                    </div>
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
                <x-slot name="footerSlot">
                    <x-adminlte-button class="bg-danger text-white" label="Tutup" data-dismiss="modal" />
                    <button id="btn-ajukan-submit" type="button" class="btn btn-success update">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
