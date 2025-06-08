{{-- Star Card --}}
<div class="card shadow-lg border-0 rounded-3">
    <!-- Card Header -->
    <div
        class="card-header bg-primary bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
            <i class="fas fa-calendar me-2"></i>Daftar Pertmuan Kelas

        </h4>
        <button type="button" class="btn btn-light d-flex align-items-center gap-2" data-bs-toggle="modal"
            data-bs-target="#tambahPertemuanModal">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah</span>
        </button>
    </div>

    <!-- Card Body -->
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle table-borderless mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="px-4 py-3 rounded-start">No</th>
                        <th scope="col" class="px-4 py-3">Guru Mengajar</th>
                        <th scope="col" class="px-4 py-3">Kelas</th>
                        <th scope="col" class="px-4 py-3">tanggal</th>
                        <th scope="col" class="px-4 py-3">Jam Mulai</th>
                        <th scope="col" class="px-4 py-3">Jam Selesai</th>
                        <th scope="col" class="px-4 py-3">Materi</th>
                        <th scope="col" class="px-4 py-3 text-center rounded-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pertemuan as $pt)
                        <tr class="bg-white shadow-sm">
                            <th scope="row" class="px-4">{{ $loop->iteration }}</th>
                            <td class="px-4">{{ $pt->pembelajaran->guru->nama }}</td>
                            <td class="px-4">{{ $pt->pembelajaran->kelas->nama_kelas }}</td>
                            <td class="px-4">
                                {{ \Carbon\Carbon::parse($pt->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-4">
                                {{ \Carbon\Carbon::parse($pt->jam_mulai)->format('H:i') }}</td>
                            <td class="px-4">
                                {{ \Carbon\Carbon::parse($pt->jam_selesai)->format('H:i') }}</td>
                            <td class="px-4">{{ $pt->materi }}</td>

                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Tombol aksi">
                                    <button type="button" class="btn btn-sm btn-outline-info px-3"
                                        data-bs-toggle="modal" data-bs-target="#editPertemuanModal-{{ $pt->id }}"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger px-3"
                                        data-bs-toggle="modal" data-bs-target="#hapusPertemuanModal-{{$pt->id}}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        {{-- Modal Include --}}
                        @include('admin.akademik.pertemuan.modal_edit_pertemuan')
                        @include('admin.akademik.pertemuan.modal_destroy_pertemuan')
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Card Footer -->
        @include('pagination_footer_card', ['collection' => $pertemuan])
    <!-- End Card Footer -->
</div>
{{-- End Card --}}
