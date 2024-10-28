{{-- Modal Detail Surat Masuk --}}
<script>
    function resizeIframe(obj) {
        const children = obj.contentWindow.document.body.innerHTML;
        const iframeDocument = obj.contentWindow.document;
        const images = iframeDocument.getElementsByTagName("img");

        if (images.length > 0) {
            images[0].style.width = "100%";
        }
    }
</script>

<x-adminlte-modal id="modalPurple" title="Detail" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>

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
                    {{-- <tr>
                        <td style="width: 40%;">Tindakan</td>
                        <td><span class="badge tindakan"></span></td>
                    </tr> --}}
                </table>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="CATATAN" theme="warning">
                <table class="table table-sm table-hover">
                    <tr>
                        <td style="width: 40%;">Revisi</td>
                        <td class="catatan"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Disposisi</td>
                        <td class="catatanKadis"></td>
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
            <div class="pdfContainer">
                <iframe onload="resizeIframe(this)" class="pdfViewer" width="100%" height="500"
                    scrolling="no"></iframe>
            </div>
    </div>

    <x-slot name="footerSlot">
        <x-adminlte-button class="bg-danger text-white" label="Tutup" data-dismiss="modal" /> </x-slot>

</x-adminlte-modal>

{{-- End Modal Detail Surat Masuk --}}
