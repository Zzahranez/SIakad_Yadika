{{-- Mengambil item dari looping di manageuser kemudian mengirim data id pada tabel users yang nanti akan diterima oleh button --}}
<div class="modal fade" id="detailUserModal-{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailUserModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('manageuser.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit me-2"></i>Edit Detail Pengguna
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Basic Information Section -->
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-id-card me-2"></i>Informasi Akun
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $item->userable->nama ?? '-' }}" placeholder="Enter full name">
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $item->email }}" placeholder="Enter email">
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            value="" placeholder="Masukan Password jika ingin diganti">
                                    </div>
                                    <!-- Konfirmasi Password -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Password</label>
                                        <input type="password" name="confirmed_password" class="form-control"
                                            value="" placeholder="Masukkan Konfirmasi Password">
                                    </div>

                                    <!-- Role -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">User Role</label>
                                        <select name="role" class="form-select">
                                            <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="siswa" {{ $item->role == 'siswa' ? 'selected' : '' }}>
                                                Student
                                            </option>
                                            <option value="guru" {{ $item->role == 'guru' ? 'selected' : '' }}>Teacher
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <select name="status_siswa" class="form-select">
                                            <option value="aktif"
                                                {{ $item->userable->status == 'aktif' ? 'selected' : '' }}>
                                                Aktif
                                            </option>
                                            <option value="lulus"
                                                {{ $item->userable->status == 'lulus' ? 'selected' : '' }}>
                                                Lulus
                                            </option>
                                            <option value="pindah"
                                                {{ $item->userable->status == 'pindah' ? 'selected' : '' }}>
                                                Pindah
                                            </option>
                                            <option value="dikeluarkan"
                                                {{ $item->userable->status == 'dikeluarkan' ? 'selected' : '' }}>
                                                Dikeluarkan
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Role-Specific Information Section -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold">
                                        @if ($item->userable_type === App\Models\Siswa::class)
                                            <i class="fas fa-graduation-cap me-2"></i>Detail Siswa
                                        @elseif ($item->userable_type === App\Models\Guru::class)
                                            <i class="fas fa-chalkboard-teacher me-2"></i>Detail Guru
                                        @elseif ($item->userable_type === App\Models\Admin::class)
                                            <i class="fas fa-user-shield me-2"></i>Detail Admin
                                        @endif
                                    </h6>
                                </div>
                                <div class="card-body">

                                    {{-- Student Details --}}
                                    @if ($item->userable_type === App\Models\Siswa::class)

                                        <!-- Profile Circle -->
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center overflow-hidden"
                                                    style="width: 100px; height: 100px;">
                                                    <img src="{{ asset('/storage/profile_siswa/' . ($item->userable->foto_profile ?? 'default-profile.jpg')) }}"
                                                        class="rounded-circle w-100 h-100 object-fit-cover"
                                                        alt="Profil {{ $item->userable->nama ?? 'Pengguna' }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- alaamat --}}
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat" class="form-control" placeholder="Enter student ID" rows="3">{{ $item->userable->alamat }}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">NIS/NISN</label>
                                                    <input type="text" name="nis_nisn" class="form-control"
                                                        value="{{ $item->userable->nis_nisn }}"
                                                        placeholder="Enter student ID">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Kelas</label>
                                                    <select name="kelas" class="form-select">
                                                        @foreach ($kelas as $kelas_tb)
                                                            <option value="{{ $kelas_tb->id }}"
                                                                {{ $item->userable->kelas_id == $kelas_tb->id ? 'selected' : '' }}>
                                                                {{ $kelas_tb->nama_kelas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" class="form-control"
                                                        value="{{ $item->userable->tanggal_lahir }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Jenis Kelamin -->
                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" class="form-select">
                                                        <option value="laki-laki"
                                                            {{ $item->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                                            Laki-laki
                                                        </option>
                                                        <option value="perempuan"
                                                            {{ $item->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                            Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- No telp --}}
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">No telepon</label>
                                                    <input type="text" name="no_telp" class="form-control"
                                                        value="{{ $item->userable->no_telp }}"
                                                        placeholder="No telepon">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Tahun Masuk</label>
                                                    <input type="year" name="tahun_masuk" class="form-control"
                                                        value="{{ $item->userable->tahun_masuk }}"
                                                        placeholder="Tahun Masuk">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Teacher Details --}}
                                    @elseif ($item->userable_type === App\Models\Guru::class)
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center overflow-hidden"
                                                    style="width: 100px; height: 100px;">
                                                    <img src="{{ asset('/storage/profile_guru/' . ($item->userable->foto_profile ?? 'default-profile.jpg')) }}"
                                                        class="rounded-circle w-100 h-100 object-fit-cover"
                                                        alt="Profil {{ $item->userable->nama ?? 'Pengguna' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Teacher ID (NIP)</label>
                                                <input type="text" name="nip" class="form-control"
                                                    value="{{ $item->userable->nip }}"
                                                    placeholder="Enter teacher ID">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" name="alamat_guru" class="form-control"
                                                    value="{{ $item->userable->alamat }}"
                                                    placeholder="Enter teacher ID">
                                            </div>
                                            {{-- Jenis Kelamin --}}
                                            <div class="col-md-4">
                                                <label class="form-label ">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-select">
                                                    <option value="laki-laki"
                                                        {{ $item->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                                        Laki-laki
                                                    </option>
                                                    <option value="perempuan"
                                                        {{ $item->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                        Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- Row 2 --}}
                                        <div class=" row mb-3">
                                            <div class="col-md-4">
                                                {{-- no_telp --}}
                                                <label class="form-label">No Telepon</label>
                                                <input type="text" name="no_telp" class="form-control"
                                                    value="{{ $item->userable->no_telp }}"
                                                    placeholder="Enter teacher ID">
                                            </div>
                                            <div class="col-md-4">
                                                {{-- Tanggal lahir --}}
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir_guru" class="form-control"
                                                    value="{{ $item->userable->tanggal_lahir }}"
                                                    placeholder="Enter teacher ID">
                                            </div>
                                            <div class="col-md-4">
                                                {{-- Tahun masuk --}}
                                                <label class="form-label">Tahun masuk</label>
                                                <input type="number" name="tahun_masuk" class="form-control"
                                                    value="{{ $item->userable->tahun_masuk }}"
                                                    placeholder="Enter teacher ID">
                                            </div>
                                        </div>

                                        {{-- Status Kepegawaian --}}
                                        <div class="mb-3">
                                            <label class="form-label ">Status Kepegawaian</label>
                                            <select name="status_kepegawaian" class="form-select">
                                                <option value="tetap"
                                                    {{ $item->userable->status_kepegawaian == 'tetap' ? 'selected' : '' }}>
                                                    Tetap
                                                </option>
                                                <option value="kontrak"
                                                    {{ $item->userable->status_kepegawaian == 'kontrak' ? 'selected' : '' }}>
                                                    Kontrak
                                                </option>
                                                <option value="honorer"
                                                    {{ $item->userable->status_kepegawaian == 'honorer' ? 'selected' : '' }}>
                                                    Honorer
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Jurusan --}}
                                        <div class=" mb-3">

                                            <label class="form-label">Jurusan</label>
                                            <input type="text" name="jurusan" class="form-control"
                                                value="{{ $item->userable->jurusan }}"
                                                placeholder="Enter teacher ID">

                                        </div>

                                        <!-- Pendidikan Terakhir -->
                                        <div class="mb-3">
                                            <label class="form-label ">Pendidikan Terakhir</label>
                                            <select name="pendidikan_terakhir" class="form-select">
                                                <option value="S1"
                                                    {{ $item->userable->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>
                                                    S1
                                                </option>
                                                <option value="S2"
                                                    {{ $item->userable->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>
                                                    S2
                                                </option>
                                                <option value="S3"
                                                    {{ $item->userable->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>
                                                    S3
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Admin Details --}}
                                    @elseif ($item->userable_type === App\Models\Admin::class)
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center overflow-hidden"
                                                    style="width: 100px; height: 100px;">
                                                    <img src="{{ asset('/storage/profile_admin/' . ($item->userable->foto_profile ?? 'default-profile.jpg')) }}"
                                                        class="rounded-circle w-100 h-100 object-fit-cover"
                                                        alt="Profil {{ $item->userable->nama ?? 'Pengguna' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat" class="form-control" rows="3" placeholder="Enter address">{{ $item->userable->alamat }}</textarea>
                                        </div>
                                        {{-- Jenis Kelamin --}}
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select">
                                                <option value="laki-laki"
                                                    {{ $item->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="perempuan"
                                                    {{ $item->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        {{-- no telepon --}}

                                        <div class="mb-3">
                                            <label class=" form-label fw-bold">No telepon</label>
                                            <input type="text" name="no_telp_admin"
                                                value="{{ $item->userable->no_telp }}" class=" form-control"
                                                placeholder="No telepon">
                                        </div>
                                        {{-- Status --}}
                                        <div class=" mb-3">
                                            <label class=" form-label fw-bold">Status</label>
                                            <select name="status_admin" class=" form-select">
                                                <option value="aktif"
                                                    {{ $item->userable->status == 'aktif' ? 'selected' : '' }}>
                                                    Aktif
                                                </option>
                                                <option value="tidak-aktif"
                                                    {{ $item->userable->status == 'tidak-aktif' ? 'selected' : '' }}>
                                                    Tidak-Aktif
                                                </option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Warning Alert -->
                    <div class="alert alert-primary d-flex align-items-center mt-3 shadow rounded-3 p-3"
                        role="alert" id="autoDismissAlert">
                        <i class="fas fa-exclamation-circle fs-4 me-3"></i>
                        <div class="fw-semibold">
                            Jangan lakukan perubahan apapun jika tidak ingin memperbarui data.
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-transparent">

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Perbarui Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
