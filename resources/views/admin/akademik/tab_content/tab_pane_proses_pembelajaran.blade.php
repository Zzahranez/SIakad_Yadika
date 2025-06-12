<!-- Redesigned Card Grid Layout -->
<div class="card border-0 shadow rounded-4 mb-5">
    <div class="card-header bg-birumantap bg-opacity-10 border-bottom-0 py-4 px-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
                <i class="fas fa-tasks me-2"></i> Daftar Jadwal Guru Mengajar
            </h4>
            <button type="button" class="btn bg-white text-dark btn-sm d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#tambahPembelajaranModal">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah</span>
            </button>
        </div>
    </div>

    <div class=" px-4">
        <!-- Form Filter -->
        <form action="{{ route('filter.pembelajaran') }}" method="GET" class="row g-3 mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="kelas_id" class="form-label">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="">Tanpa Filter</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}"
                                {{ request('kelas_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="guru_id" class="form-label">Guru</label>
                    <select name="guru_id" id="guru_id" class="form-control">
                        <option value="">Tanpa Filter</option>
                        @foreach ($guru as $item)
                            <option value="{{ $item->id }}" {{ request('guru_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" class="form-control">
                        <option value="">Tanpa Filter</option>
                        @foreach ($mapels as $item)
                            <option value="{{ $item->id }}"
                                {{ request('mapel_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-3 ms-auto d-flex justify-content-end gap-2">
                <button type="submit" class="btn bg-birumantap text-white hover-smooth w-50">Filter</button>
                <a href="{{ route('managepembelajaran.index') }}"
                    class="btn btn-secondary text-white hover-smooth w-50">Reset</a>
            </div>
        </form>
    </div>
    <div class="card-body p-4">
        <!-- Error Alerts -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Card Grid -->
        <div class="row g-4">
            @foreach ($pembelajaran as $item_pemb)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow rounded-4 h-100 bg-light position-relative">
                        <!-- Card Header with Gradient Overlay -->
                        <div class="card-header bg-primary bg-opacity-10 border-0 p-3 position-relative">
                            <div class="d-flex justify-content-between align-items-center">
                                <span
                                    class="badge bg-birumantap text-white rounded-pill px-3 py-2 fs-6 fw-medium">{{ $loop->iteration }}</span>
                                <div class="dropdown" style="z-index: 1050;">
                                    <button class="btn btn-outline-dark btn-sm rounded-circle shadow-sm" type="button"
                                        id="dropdownMenuButton-{{ $item_pemb->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 p-2"
                                        aria-labelledby="dropdownMenuButton-{{ $item_pemb->id }}">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2 text-primary"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#editPembModal-{{ $item_pemb->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2 text-danger"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#hapusPembelajaranModal-{{ $item_pemb->id }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Subtle Gradient Overlay for Visual Depth -->
                            <div class="position-absolute top-0 start-0 w-100 h-100"
                                style="background: linear-gradient(180deg, rgba(13, 110, 253, 0.1) 0%, rgba(255, 255, 255, 0) 100%); z-index: 1;">
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4">
                            <h5 class="card-title text-dark fw-bold mb-3">{{ $item_pemb->kelas->nama_kelas }}</h5>
                            <p class="card-text mb-2 text-muted d-flex align-items-center gap-2">
                                <i class="fas fa-user-tie text-success fs-5"></i>
                                <span>{{ $item_pemb->guru->nama }}</span>
                            </p>
                            <p class="card-text mb-3 text-muted d-flex align-items-center gap-2">
                                <i class="fas fa-book text-info fs-5"></i>
                                <span>{{ $item_pemb->mapel->nama_mapel }}</span>
                            </p>
                            <!-- Subtle Divider -->
                            <hr class="border-primary border-opacity-25">
                            <small class="text-muted d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-alt text-secondary"></i>
                                <span>Terakhir diubah: {{ $item_pemb->updated_at->format('d M Y') }}</span>
                            </small>
                        </div>
                        <!-- Card Footer with Action Indicator -->
                        <div class="card-footer bg-transparent border-0 p-3 pt-0">
                            <div class="d-flex justify-content-end">
                                <!-- Removed badge to match your latest code -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Includes -->
                @include('admin.akademik.pembelajaran.modal_edit_proses_pembelajarann')
                @include('admin.akademik.pembelajaran.modal_destroy_prosespembelajaran')
            @endforeach
        </div>
    </div>

    @include('pagination_footer_card', ['collection' => $pembelajaran])
</div>


{{-- Modal Tambah Pembelajaran Modal --}}
<div class="modal fade" id="tambahPembelajaranModal" tabindex="-1" aria-labelledby="tambahPembelajaranModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPembelajaranModal">Tambah Jadwal Mengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('managepembelajaran.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{-- Input --}}
                    <div class="mb-3">

                        <select class=" form-select" id="kelas_id" name="kelas_id">
                            <option value="" selected disabled>Pilih Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">

                        <select class=" form-select" id="guru_id" name="guru_id">
                            <option value="" selected disabled>Pilih Guru</option>
                            @foreach ($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">

                        <select class=" form-select" id="mapel_id" name="mapel_id">
                            <option value="" selected disabled>Pilih Mata Pelajaran</option>
                            @foreach ($mapels as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
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
