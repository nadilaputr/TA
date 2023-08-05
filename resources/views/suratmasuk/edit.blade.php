    <x-adminlte-modal id="edit_surat_masuk{{ $row->id }}" title="Edit Surat Masuk" theme="info" icon="fa fa-md fa-fw fa-info-circle "
        size='lg' disable-animations v-centered static-backdrop scrollable>

        <div class="card card-info">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> <br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">
            <form action="{{ route('masuk.update', $row->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" class="form-control" placeholder="Nomor Surat" name="nomor_surat"
                            value="{{ $row->nomor_surat }}">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input type="date" class="form-control" name="tanggal_surat" required
                            value="{{ $row->tanggal_surat }}">
                    </div>

                    <div class="form-group">
                        <label>Alamat Surat</label>
                        <input type="text" name="asal_surat" value="{{ $row->asal_surat }}" class="form-control"
                            placeholder="Alamat Surat">
                    </div>

                    <div class="form-group">
                        <label>File</label>
                        <input type="file"  class="form-control" name="file" required value="{{ $row->file }}">
                    </div>

                    <div class="form-group">
                        <label>Perihal</label>
                        <input type="text" name="perihal" value="{{ $row->perihal }}" class="form-control"
                            placeholder="Perihal">
                    </div>

                    <div class="form-group">
                        <label>Sifat</label>
                        <x-adminlte-select id="sifat" name="sifat" value="{{ $row->sifat }}">
                            <option selected>{{ $row->sifat }}</option>
                            <option value="biasa">Biasa</option>
                            <option value="segera">Segera</option>
                            <option value="sangat_segera">Sangat Segera</option>
                        </x-adminlte-select>
                    </div>

                    <div class="form-group">
                        <label>Lampiran</label>
                        <x-adminlte-select id="lampiran" name="lampiran" value="{{ $row->lampiran }}">
                            <option selected>{{ $row->lampiran }}</option>
                            <option value="1">1 Lembar</option>
                            <option value="2">2 Lembar</option>
                            <option value="3">3 Lembar</option>
                            <option value="4">4 Lembar</option>
                            <option value="5">5 Lembar</option>
                        </x-adminlte-select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <x-adminlte-select id="status" name="status" value="{{ $row->status }}">
                            <option selected>{{ $row->status }}</option>
                            <option  value="asli">Asli</option>
                            <option  value="tembusan">Tembusan</option>
                        </x-adminlte-select>
                    </div>
                    <div class="form-group">
                        <label>Tindakan</label>
                        <x-adminlte-select id="tindakan" name="tindakan" value="{{ $row->tindakan }}">
                            <option selected>{{ $row->tindakan }}</option>
                            <option value="diteruskan">Diteruskan</option>
                            <option value="tidak_diteruskan">Tidak Diteruskann</option>
                        </x-adminlte-select>
                    </div>
                    
                    
                </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    {{-- <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </div> --}}
                </form>
        </div>

    </x-adminlte-modal>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            $('.btn-edit').on('click', function(event) {
    
                var id = $(this).data('id');
    
                $.get(`masuk/${id}`, function(surat) {
                    $('#id').val(surat.id);
                    $('#nomor_surat').val(surat.nomor_surat);
                    $('#tanggal_surat').val(surat.tanggal_surat);
                    $('#alamat_surat').val(surat.asal_surat);
                    $('#tanggal_masuk').val(surat.tanggal_diterima);
                    $('#perihal').val(surat.perihal);
                    $('#status').val(surat.status);
                    $('#lampiran').val(surat.lampiran);
                    $('#tindakan').val(surat.tindakan);
                    $('#sifat').val(surat.sifat);
                    // Note: File input can't be set directly due to security reasons
                })
            });
        })
    </script>
