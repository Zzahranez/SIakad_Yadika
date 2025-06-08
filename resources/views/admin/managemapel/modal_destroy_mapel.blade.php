<div class="modal fade" id="hapusMapelModal-{{ $mapel_item->id }}" tabindex="-1"
    aria-labelledby="modalTitle-{{ $mapel_item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle-{{ $mapel_item->id }}">Edit Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('managemapel.destroy', $mapel_item->id)}}" method="POSt">
                @csrf
                @method('DELETE')
                <!--Main Content Modal -->
                <div class=" d-flex justify-content-center align-items-center p-3">
                    <p>Apakah anda yakin ingin menghapus mapel <b>{{ $mapel_item->nama_mapel }}</b>?</p>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
