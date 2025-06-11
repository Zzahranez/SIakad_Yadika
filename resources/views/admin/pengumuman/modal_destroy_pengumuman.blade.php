<div class="modal fade" id="hapusPengumuman-{{$pm->id}}" tabindex="-1"
    aria-labelledby="modalTitle-{{$pm->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle-{{$pm->id}}">Edit Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admindash.destroyPengumuman', $pm->id)}}" method="POSt">
                @csrf
                @method('DELETE')
                <!--Main Content Modal -->
                <div class=" d-flex justify-content-center align-items-center p-3">
                    <p>Apakah anda yakin ingin menghapus pengumuman <b>{{$pm->title}} </b>?</p>
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
