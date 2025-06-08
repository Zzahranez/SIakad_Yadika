<div id="guruForm" class="role-form" style="display: none;">
    <hr>
    <div class="mb-3">
        <h6 class="fw-bold">Data Guru</h6>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nama_guru" class="form-label">Nama Guru<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_guru" name="nama_guru" required maxlength="255">
        </div>
        <div class="col-md-6">
            <label for="nip" class="form-label">NIP<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nip" name="nip" required maxlength="18">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="jenis_kelamin_guru" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
            <select class="form-select" id="jenis_kelamin_guru" name="jenis_kelamin_guru" required>
                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="no_telp_guru" class="form-label">No. Telepon<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="no_telp_guru" name="no_telp_guru" required maxlength="15"
                pattern="[0-9]+">
        </div>
    </div>

    <div class="mb-3">
        <label for="alamat_guru" class="form-label">Alamat<span class="text-danger">*</span></label>
        <textarea class="form-control" id="alamat_guru" name="alamat_guru" rows="3" required maxlength="500"></textarea>
    </div>

    {{-- Status kepegawaian dan tangal lahir --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Status Kepegawaian</label>
            <select name="status_kepegawaian" class="form-select">
                <option value="tetap">
                    Tetap
                </option>
                <option value="kontrak">
                    Kontrak
                </option>
                <option value="honorer">
                    Honorer
                </option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="tanggal_lahir_guru" name="tanggal_lahir_guru" required
                maxlength="15">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir_guru" class="form-select">
                <option value="S1">
                    Sarjana
                </option>
                <option value="S2">
                    Magister
                </option>
                <option value="S3">
                    Doktor
                </option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan_guru" class="form-control" placeholder="Jurusan">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            {{-- Tahun masuk --}}
            <label class="form-label">Tahun masuk</label>
            <input type="year" name="tahun_masuk_guru" class="form-control" placeholder="Masukkan tahun masuk">
        </div>
    </div>

</div>
