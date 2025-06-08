<div class="modal fade" id="editPertemuanModal-{{ $pt->id }}" tabindex="-1" aria-labelledby="modalTitle-#"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle-#">Edit Pertemuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{route('managepertemuan.update', $pt->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="fas fa-school text-primary me-2"></i>Kelas</span>
                                <strong>{{ $pt->pembelajaran->kelas->nama_kelas }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="fas fa-user-tie text-success me-2"></i>Guru Mengajar</span>
                                <strong>{{ $pt->pembelajaran->guru->nama }}</strong>
                            </li>
                        </ul>
                    </div>
                    {{-- Input Tanggal --}}
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Pertemuan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ $pt->tanggal }}" required>
                    </div>

                    {{-- Input Jam Mulai --}}
                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                            value="{{ $pt->jam_mulai }}" required>
                    </div>

                    {{-- Input Jam Selesai --}}
                    <div class="mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                            value="{{ $pt->jam_selesai }}" required>
                    </div>

                    {{-- Input Materi --}}
                    <div class="mb-3">
                        <label for="materi" class="form-label">Materi Pertemuan</label>
                        <textarea class="form-control" id="materi" name="materi" rows="3">{{ $pt->materi }}</textarea>
                    </div>




                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
