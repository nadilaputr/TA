{{-- Modal Detail Surat Keluar --}}
<x-adminlte-modal id="modalPurple" title="DETAIL" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="light">
                <table class="table table-sm table-hover">
                    <tr>
                        <td>Dari Bidang</td>
                        <td class="tingkat_keamanan"></td>
                    </tr>
                    <tr>
                        <td>Sifat</td>
                        <td class="sifat"></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td class="lampiran"></td>
                    </tr>
                </table>
            </x-adminlte-card>
        </div>
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
                <td>Alamat Surat</td>
                <td class="alamat_surat"></td>
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
                <td>
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn" title="Lihat File">View</button>
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

    


    <x-slot name="footerSlot">
        <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" /> </x-slot>

</x-adminlte-modal>

