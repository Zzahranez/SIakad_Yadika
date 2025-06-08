<div class="modal fade" id="hapusPresensiModal-{{ $presen->id }}" tabindex="-1"
    aria-labelledby="modalTitle-{{ $presen->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <!-- Header -->
            <div class="modal-header bg-danger text-white border-0">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                    <h5 class="modal-title mb-0" id="modalTitle-{{ $presen->id }}">Konfirmasi Hapus Presensi</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{route('managepresensi.destroy', $presen->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h6 class="fw-bold text-dark mb-2">Apakah Anda yakin ingin menghapus presensi berikut ?</h6>
                        <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan</p>
                    </div>

                    <!-- Schedule Details Card -->
                    <div class="card border-0 bg-light">
                        <div class="card-body p-3">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-door-open text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Nama Siswa</small>
                                            <span class="fw-semibold">{{$presen->siswa->nama}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-person-check text-success"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Guru Mengajar</small>
                                            <span class="fw-semibold">{{$presen->pertemuan->pembelajaran->guru->nama}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-book text-warning"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Kelas</small>
                                            <span class="fw-semibold">{{$presen->pertemuan->pembelajaran->kelas->nama_kelas}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger flex-fill">
                            <i class="bi bi-trash3 me-1"></i>
                            Hapus
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
