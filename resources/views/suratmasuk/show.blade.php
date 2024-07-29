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

<x-adminlte-modal id="modalPurple" title="DETAIL" theme="white" icon="fa fa-md fa-fw fa-info-circle " size='lg'
    disable-animations v-centered scrollable>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="light">
                <table class="table table-sm table-hover">
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
                </table>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="INFORMASI TINDAKAN" theme="warning">
                <table class="table table-sm table-hover">
                    <tr>
                        <td style="width: 40%;">Catatan</td>
                        <td class="catatan"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Catatan Kadis</td>
                        <td class="catatanKadis"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Tindakan</td>
                        <td><span class="badge tindakan"></span></td>
                    </tr>
                    <tr>
                        <td>Tanggal Input</td>
                        <td class="tanggal_masuk"></td>
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
                <td>
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn"
                        title="Lihat File">View</button>
                </td>
            </tr>
        </table>
    </x-adminlte-card>

    <div class="card">
        <div class="card-body">
            <div class="pdfContainer">
                <iframe onload="resizeIframe(this)" class="pdfViewer" width="100%" height="500"
                    scrolling="no"></iframe>
            </div>

        </div>
    </div>

    <x-slot name="footerSlot">
        <x-adminlte-button class="bg-danger text-white" label="Close" data-dismiss="modal" /> </x-slot>

</x-adminlte-modal>

{{-- End Modal Detail Surat Masuk --}}
