<!-- Modal -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserModalLabel">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="addUserForm" method="POST" action="{{ route('manageuser.store') }}">
                    @csrf

                    <!-- Data Umum User -->
                    <div class="mb-3">
                        <h6 class="fw-bold">Data Akun</h6>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required
                                minlength="8">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <!-- Dynamic Forms Based on Role -->
                    <div id="siswaForm" class="role-form" style="display: none;">
                        <hr>
                        <div class="mb-3">
                            <h6 class="fw-bold">Data Siswa</h6>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_siswa" class="form-label">Nama Siswa<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nis" class="form-label">NIS/NISN<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nis" name="nis_nisn" required
                                    maxlength="20">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="kelas" class="form-label">Kelas<span class="text-danger">*</span></label>
                                <select class="form-select" id="kelas" name="kelas" required>
                                    <option value="" selected disabled>Pilih kelas</option>
                                    @foreach ($kelas as $kelas_tb)
                                        <option value="{{ $kelas_tb->id }}">{{ $kelas_tb->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis_kelamin_siswa" class="form-label">Jenis Kelamin<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_kelamin_siswa" name="jenis_kelamin_siswa"
                                    required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk"
                                    required min="2000" max="{{ date('Y') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_telp_siswa" class="form-label">No. Telepon<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_telp_siswa" name="no_telp_siswa"
                                    required maxlength="15" pattern="[0-9]+">
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="alamat_siswa" class="form-label">Alamat<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat_siswa" name="alamat_siswa" rows="3" required maxlength="500"></textarea>
                        </div>
                    </div>

                    {{-- Form guru --}}
                    @include('admin.manageuser.component.form_guru')
                    {{-- End guru form --}}






                    {{-- Admin form --}}
                    <div id="adminForm" class="role-form" style="display: none;">
                        <hr>
                        <div class="mb-3">
                            <h6 class="fw-bold">Data Admin</h6>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_admin" class="form-label">Nama Admin<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_admin" name="nama_admin"
                                    required maxlength="255">
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin_admin" class="form-label">Jenis Kelamin<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_kelamin_admin" name="jenis_kelamin_admin"
                                    required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_telp_admin" class="form-label">No. Telepon<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_telp_admin" name="no_telp_admin"
                                    required maxlength="15" pattern="[0-9]+">
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="status_admin" class="form-label">Status<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="status_admin" name="status_admin" required>
                                    <option value="" selected disabled>Pilih status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak-aktif">Tidak-Aktif</option>
                                </select>
                            </div>
                            <div class="col-md6">
                                <label for="tanggal_lahir_admin" class="form-label">Tanggal Lahir<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir_admin"
                                    name="tanggal_lahir_admin">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="no_telp_admin" class="form-label">No telepon<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_telp_admin" name="no_telp_admin">
                        </div>

                        <div class="mb-3">
                            <label for="alamat_admin" class="form-label">Alamat<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat_admin" name="alamat_admin" rows="3" required maxlength="500"></textarea>
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
</div>
