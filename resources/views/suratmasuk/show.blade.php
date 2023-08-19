{{-- Modal Detail Surat Masuk --}}
<x-adminlte-modal id="modalPurple" title="Detail" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="NOMOR AGENDA" theme="light">
                <table class="table table-sm table-hover">
                    <tr>
                        <td>No</td>
                        <td class="id"></td>
                    </tr>
                    <tr>
                        <td>Sifat</td>
                        <td class="sifat"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Diterima</td>
                        <td class="tanggal_masuk"></td>
                    </tr>
                </table>
            </x-adminlte-card>
        </div>
   

     <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="warning">
                <table class="table table-sm table-hover">
                     <tr>
                <td style="width: 40%;">Catatan</td>
                <td class="catatan"></td>
            </tr>
            <tr>
                <td style="width: 40%;">Tindakan</td>
                <td class="tindakan"></td>
            </tr>
            <tr>
                <td style="width: 40%;">Jenis</td>
                <td class="jenis"></td>
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
                    <a target="_blank" class="btn btn-xs btn-default text-primary mx-1 shadow downloadFile"
                        title="Lihat File">Download
                        <i class="fa fa-lg fa-fw fa-file"></i>
                    </a>
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn"
                        title="Lihat File">Lihat PDF
                    </button>
                </td>
            </tr>
        </table>
    </x-adminlte-card>




    <x-slot name="footerSlot">
        <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" /> </x-slot>

</x-adminlte-modal>
{{-- End Modal Detail Surat Masuk --}}