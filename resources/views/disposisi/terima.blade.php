<x-adminlte-modal id="terimaModal" title="Terima Disposisi" theme="white" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>

    <div class="row">
        <div class="col-md-6">
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
        </div>

        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="CATATAN" theme="warning">
                <table class="table table-sm table-hover">
                    <tr>
                        <td>Disposisi</td>
                        <td class="catatan"></td>
                    </tr>
                    <tr>
                        <td>Sifat</td>
                        <td class="sifat"></td>
                    </tr>
                </table>
            </x-adminlte-card>
        </div>
    </div>

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
        <div class="card-body">
            <form id="terimaForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>TindakanSurat</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih TindakanSurat</option>
                        <option value="{{ ARSIP }}">Diterima</option>
                    </select>
                </div>
                <x-slot name="footerSlot">
                    <button type="button" class="btn btn-success update" id="terimaTindakanSubmitBtn">Simpan</button>
                </x-slot>

            </form>

        </div>
    </div>
</x-adminlte-modal>
