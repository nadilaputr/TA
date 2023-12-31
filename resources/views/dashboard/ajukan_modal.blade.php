<x-adminlte-modal id="ajukanModal" title="Ajukan" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>

    
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
        <div class="card-body bg-light">
            <form id="ajukanForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="tindakan">Tindakan Surat</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih Tindakan</option>
                        <option value="{{ REVISI }}">Koreksi kembali</option>
                        <option value="{{ MENUNGGU_INSTRUKSI_KEPALA }}">Ajukan ke Kepala Dinas</option>
                    </select>
                </div>

                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan" />
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" />
                    <button id="btn-ajukan-submit" type="button" class="btn btn-primary update">Simpan</button>
                </x-slot>
            </form>


        </div>
    </div>

</x-adminlte-modal>
