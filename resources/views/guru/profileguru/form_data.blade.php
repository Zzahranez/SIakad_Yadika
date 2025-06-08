<div class="tab-pane fade show active slide-in" id="personal" role="tabpanel" aria-labelledby="personal-tab">
    <div class="card shadow p-4">
        <div class="card-header bg-transparent border-0 pb-0">
            <h4 class="mb-0 text-primary"><i class="fas fa-id-card me-2"></i>Data Identitas</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if (session('info'))
                <div class="alert alert-info">{{ session('info') }}</div>
            @endif

            <form action="{{ route('profileguru.UpdateDetailguru') }}" method="POST" id="personalForm">
                @csrf
                @method('PUT')
                <div class="row">


                    {{-- Baris 1 --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP"
                                value="{{ $guru->userable->nip }}">
                            <label for="nip"><i class="fas fa-id-badge me-2"></i>NIP</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="jenis_kelamin" class="form-select" id="jenis_kelamin">
                                <option value="laki-laki"
                                    {{ $guru->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="perempuan"
                                    {{ $guru->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            <label for="jenis_kelamin"><i class="fas fa-venus-mars me-2"></i>Jenis
                                Kelamin</label>
                        </div>
                    </div>
                </div>

                {{-- Baris 2 --}}
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat"
                            value="{{ $guru->userable->alamat }}">
                        <label for="alamat"><i class="fas fa-home me-2"></i>Alamat</label>
                    </div>
                </div>

                {{-- Baris 3 --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="no_telp_guru" id="no_telp_guru" class="form-control"
                                placeholder="no_telp_guru" value="{{ $guru->userable->no_telp }}">
                            <label for="no_telp_guru"><i class="fas fa-phone me-2"></i>No Telepon</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="status_kepegawaian" class="form-select">
                                <option value="tetap"
                                    {{ $guru->userable->status_kepegawaian == 'tetap' ? 'selected' : '' }}>
                                    Tetap
                                </option>
                                <option value="kontrak"
                                    {{ $guru->userable->status_kepegawaian == 'kontrak' ? 'selected' : '' }}>
                                    Kontrak
                                </option>
                                <option value="honorer"
                                    {{ $guru->userable->status_kepegawaian == 'honorer' ? 'selected' : '' }}>
                                    Honorer
                                </option>
                            </select>
                            <label for="status_kepegawaian"><i class="fas fa-user-tie me-2"></i>Status
                                kepegawaian</label>

                        </div>
                    </div>
                </div>
                {{-- Baris 4 --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="jurusan" class="form-control"
                                value="{{ $guru->userable->jurusan }}" placeholder="Enter teacher ID">
                            <label for="jurusan"><i class="fas fa-graduation-cap me-2"></i>Jurusan</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="pendidikan_terakhir" class="form-select">
                                <option value="S1"
                                    {{ $guru->userable->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>
                                    S1 Sarjana
                                </option>
                                <option value="S2"
                                    {{ $guru->userable->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>
                                    S2 Magister
                                </option>
                                <option value="S3"
                                    {{ $guru->userable->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>
                                    S3 Doktor
                                </option>
                            </select>
                            <label for="pendidikan_terakhir"><i class="fas fa-university me-2"></i>Pendidikan
                                Terakhir</label>
                        </div>
                    </div>
                </div>
                {{-- Baris 5 --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="tanggal_lahir_guru" class="form-control"
                                value="{{ $guru->userable->tanggal_lahir }}" placeholder="Enter teacher ID">
                            <label for="tanggal_lahir_guru"><i class="fas fa-birthday-cake me-2"></i>Tanggal
                                Lahir</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            {{-- Tahun masuk --}}
                            <input type="number" name="tahun_masuk" class="form-control"
                                value="{{ $guru->userable->tahun_masuk }}" placeholder="Enter teacher ID">
                            <label for="status_kepegawaian"><i class="fas fa-calendar-check me-2"></i>Tahun
                                masuk</label>
                        </div>
                    </div>

                </div>


                {{-- Button --}}
                <div class="row mt-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('gurudash.index') }}" class="btn btn-danger w-100">
                            <i class="fas fa-arrow-left me-2"></i>Kembali Ke Dashboard
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
