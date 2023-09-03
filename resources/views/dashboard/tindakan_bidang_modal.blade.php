<x-adminlte-modal id="bidangModal" title="Disposisi Bidang" theme="white" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>

    <div class="col-md-6">
        <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="light">
            <table class="table table-sm table-hover">
                <tr>
                    <td>Tkt. Keamanan</td>
                    <td class="tingkat_keamanan"></td>
                </tr>
                <tr>
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
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn"
                        title="Lihat File">View
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
        <div class="card-body">
            <form id="tindakanBidangForm" method="POST">
                @csrf

                <div class="form-group">
                    <label for="tindakanbidang">Tindakan Surat</label>
                    <select id="tindakanbidang" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih Tindakan</option>
                        <option value="{{ ARSIP }}">Tidak Disposisi</option>
                        <option value="{{ TINDAK_LANJUT }}">Disposisi</option>
                    </select>
                </div>

                <div class="form-group" id="containerbidang">
                    <label>Bidang</label>
                    <select class="form-control bidang" name="id_bidang" id="bidang" required>
                    </select>
                </div>

                <div class="form-group" id="container">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatanBidang" required />
                </div>

                <x-slot name="footerSlot">
                    <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" />
                    <button type="button" class="btn btn-success btn-submit-bidang update">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
