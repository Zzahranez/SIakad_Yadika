<div class="modal fade" id="editPengumuman-{{ $pm->id }}" tabindex="-1"
    aria-labelledby="modalTitle-{{ $pm->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle-{{ $pm->id }}">Edit Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{route('admindash.EditPengumuman', $pm->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $pm->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <!-- Hidden input + trix-editor -->
                        <input id="isi{{ $pm->id }}" type="hidden" name="isi" value="{{ $pm->isi }}">
                        <trix-editor input="isi{{ $pm->id }}"></trix-editor>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
