<x-adminlte-modal id="bidangModal" title="Disposisi Bidang" theme="white" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>

    <div class="col-md-6">
        <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="light">
            <table class="table table-sm table-hover">
                <tr>
                    <td>Sifat</td>
                    <td class="sifat"></td>
                </tr>
                <tr>
                    <td style="width: 40%;">Jenis</td>
                    <td id="jn" class="jenis"></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td class="lampiran"></td>
                </tr>
                <tr>
                    <td>Tanggal Input</td>
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
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn" title="Lihat File">View
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
                    <x-adminlte-button class="bg-danger text-white" label="Tutup" data-dismiss="modal" />
                    <button type="button" class="btn btn-success btn-submit-bidang update">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>

@section('js')
    <script>
        $(document).ready(function() {
            if ($("#tindakan").val() === "1") {
                $('#catatanContainer').show();
                $('#informasi_tambahan').hide();
            } else if ($("#tindakan").val() === "2") {
                $('#informasi_tambahan').show();
                $('#catatanContainer').hide();
            } else {
                $('#catatanContainer').hide();
                $('#informasi_tambahan').hide();
            }

            $("#tindakan").change(function() {
                var selectedOption = $(this).val();

                if ($("#tindakan").val() === "1") {
                    $('#catatanContainer').show();
                    $('#informasi_tambahan').hide();
                } else if ($("#tindakan").val() === "2") {
                    $('#informasi_tambahan').show();
                    $('#catatanContainer').hide();
                } else {
                    $('#catatanContainer').hide();
                    $('#informasi_tambahan').hide();

                }
            });
            const tindakanToString = (status) => {
                console.log(status);
                switch (status) {
                    case {{ DITERIMA }}:
                        return "Diterima";
                    case {{ REVISI }}:
                        return "Revisi";
                    case {{ ARSIP }}:
                        return "Arsip";
                }
            }

            const tindakanToBadge = (status) => {
                switch (status) {
                    case {{ DITERIMA }}:
                        return "success";
                    case {{ REVISI }}:
                        return "warning";
                    case {{ ARSIP }}:
                        return "success";
                }
            }

            $('.pdfContainer').hide();

            let suratId;

            $('#bidangModal').on('show.bs.modal', function(e) {

                //get data-id attribute of the clicked element
                var suratId = $(e.relatedTarget).data('id');

                $.get(`suratmasuk/${suratId}`, function(data) {
                    console.log(data);

                    $('.id').html(data.data.id);
                    $('.nomor_surat').html(data.data.nomor_surat);
                    $('.tanggal_surat').html(data.data.tanggal_surat);
                    $('.asal_surat').html(data.data.asal_surat);
                    $('.lampiran').html(data.data.lampiran);
                    $('.tanggal_masuk').html(data.data.tanggal_masuk);
                    $('.perihal').html(data.data.perihal);
                    $('.jenis').html(data.data.jenis);
                    $('.sifat').html(data.data.sifat);
                    $('.downloadFile').attr('href', '{{ asset(':file') }}'.replace(
                        ':file', data.data.file))
                    $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
                        .replace(':file', data.data.file))
                })
            });
        })



        // $('.btn-detail').on('click', function(event) {

        //     $('.pdfContainer').hide();

        //     suratId = $(this).data('id');

        //     $.get(`suratmasuk/${suratId}`, function(data) {
        //         $('.id').html(data.data.id);
        //         $('.nomor_surat').html(data.data.nomor_surat);
        //         $('.tanggal_surat').html(data.data.tanggal_surat);
        //         $('.asal_surat').html(data.data.asal_surat);
        //         $('.tanggal_masuk').html(data.data.tanggal_masuk);
        //         $('.perihal').html(data.data.perihal);
        //         $('.sifat').html(data.data.sifat);
        //         $('.tindakan').text(tindakanToString(data.data.tindakan));
        //         $('.tindakan').addClass(`badge-${tindakanToBadge(data.data.tindakan)}`)
        //         $('.lampiran').html(data.data.lampiran);
        //         $('.jenis').html(data.data.jenis);
        //         $('.catatanKadis').html(data.data.disposisi != null ? data.data.disposisi
        //             .catatan :
        //             "-");
        //         $('.catatan').html(data.data.catatan ?? "-");
        //         $('.pdfViewerBtn').attr('data-url', '{{ asset(':file') }}'
        //             .replace(':file', data.data.file))
        //     })
        // });
    </script>
@endsection
