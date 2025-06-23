{{-- Modal Edit --}}
<div class="modal fade" id="editKelas-{{ $kelas_item->id }}" tabindex="-1"
    aria-labelledby="editKelas-{{ $kelas_item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editKelas">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('managekelas.update', $kelas_item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaKelas" class="form-label">Nama
                            Kelas</label>
                        <input type="text" class="form-control" id="namaKelas" name="nama_kelas_edit"
                            pattern="^[0-9]{1,2}\s[A-Z]+[0-9]*$" placeholder="Misal: XII IPA 1"
                            value="{{ $kelas_item->nama_kelas }}" required>
                        <small class="text-muted">Format: angka spasi huruf
                            besar (misal: 11 B)</small>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
