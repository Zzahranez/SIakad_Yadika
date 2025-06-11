<div class="tab-pane fade show active" id="managekelas" role="tabpanel" aria-labelledby="managekelas-tab">
    <div class="card shadow-lg  border-0 rounded-3">
        <!-- Card Header -->
        <div
            class="card-header bg-birumantap bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
                <i class="fas fa-chalkboard-teacher me-2"></i> Daftar Kelas
            </h4>
            <button type="button" class="btn btn-light d-flex align-items-center gap-2" data-bs-toggle="modal"
                data-bs-target="#tambahKelas">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Kelas</span>
            </button>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-borderless mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 rounded-start">No</th>
                            <th scope="col" class="px-4 py-3">Kelas</th>
                            <th scope="col" class="px-4 py-3 text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $kelas_item)
                            <tr class="bg-white shadow-sm">
                                <th scope="row" class="px-4">{{ $loop->iteration }}</th>
                                <td class="px-4">{{ $kelas_item->nama_kelas }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Tombol aksi">
                                        <button type="button" class="btn btn-sm btn-outline-info px-3"
                                            data-bs-toggle="modal" data-bs-target="#editKelas-{{ $kelas_item->id }}"
                                            data-id="{{ $kelas_item->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-end px-3"
                                            data-bs-toggle="modal" data-bs-target="#hapusKelas-{{ $kelas_item->id }}"
                                            data-id="{{ $kelas_item->id }}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Include Modals -->
                            @include('admin.manage_kelas.modal_edit_kelas')
                            @include('admin.manage_kelas.modal_hapus_kelas')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!--Card footer-->
        @include('pagination_footer_card', ['collection' => $kelas])

        <!-- -->
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="tambahKelas" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKelas">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('managekelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaKelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="namaKelas" name="nama_kelas"
                            pattern="^[0-9]{1,2}\s[A-Z]+[0-9]*$" placeholder="Misal: XII IPA 1" required>
                        <small class="text-muted">Format: angka spasi huruf besar (misal: 11 B)</small>
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
