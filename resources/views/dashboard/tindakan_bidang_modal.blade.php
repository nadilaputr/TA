<x-adminlte-modal id="bidangModal" title="Bidang" theme="white" icon="fas fa-solid fa-file-medical" size='lg' v-centered
    scrollable>
    <x-adminlte-card id="detailsurat" title="Detail Surat" theme="lightblue" icon="fas fa-lg fa-fan">
        <table class="table table-sm">
            <tr>
                <td>No</td>
                <td class="id"></td>
            </tr>
            <tr>
                <td>Asal Surat</td>
                <td class="asal_surat"></td>
            </tr>
            <tr>
                <td>Nomor Surat</td>
                <td class="nomor_surat"></td>
            </tr>
            <tr>
                <td>Tanggal Surat</td>
                <td class="tanggal_surat"></td>
            </tr>
            <tr>
                <td>Perihal Surat</td>
                <td class="perihal"></td>
            </tr>
            <tr>
                <td>Tanggal Diterima</td>
                <td class="tanggal_masuk"></td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td class="jenis"></td>
            </tr>
            <tr>
                <td>File</td>
                <td class="d-flex">
                    {{-- <a target="_blank"
                       class="btn btn-xs btn-default text-primary mx-1 shadow downloadFile" title="Lihat File">Download
                        <i class="fa fa-lg fa-fw fa-file"></i>
                    </a> --}}
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn" title="Lihat File">Lihat
                        PDF
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
                    <label>Bidang</label>
                    <select class="form-control bidang" name="id_bidang" id="bidang" required>
                    </select>
                </div>

                <div class="form-group" id="catatanBidangContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatanBidang" required />
                </div>

                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-secondary" label="Close" data-dismiss="modal" />
                    <button type="button" class="btn btn-success btn-submit-bidang update">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
