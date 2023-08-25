<x-adminlte-modal id="deleteModalSuratKeluar" title="Hapus Surat Keluar" size="md" theme="white" icon="fa fa-sm fa-fw fa-trash" v-centered scrollable>
    <div>Anda yakin ingin menghapus Surat Keluar ?</div>
    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="danger" label="Batal" data-dismiss="modal" />
        <x-adminlte-button theme="secondary" label="Hapus" id="confirmDeleteSuratKeluarBtn" />
    </x-slot>
</x-adminlte-modal>
