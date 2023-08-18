<x-adminlte-modal id="ajukanModal" title="Ajukan" theme="navy" icon="fas fa-solid fa-file-medical" size='lg' v-centered
                  scrollable>
    <x-adminlte-card id="detailsurat" title="Detail Surat" theme="navy" icon="fas fa-lg fa-fan" collapsible>
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
                    <a target="_blank"
                       class="btn btn-xs btn-default text-primary mx-1 shadow downloadFile" title="Lihat File">Download
                        <i class="fa fa-lg fa-fw fa-file"></i>
                    </a>
                    <button
                        class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn"
                        title="Lihat File">Lihat PDF
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
            <form id="ajukanForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan"/>
                </div>

                <div class="form-group">
                    <label for="tindakan">TindakanSurat</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih TindakanSurat</option>
                        <option value="{{ REVISI }}">Koreksi kembali</option>
                        <option value="{{ TINDAK_LANJUT }}">Tindak Lanjut ke Kepala DInas</option>
                    </select>
                </div>
                <button id="btn-ajukan-submit" type="button" class="btn btn-primary update">Simpan</button>
            </form>

        </div>
    </div>
</x-adminlte-modal>
