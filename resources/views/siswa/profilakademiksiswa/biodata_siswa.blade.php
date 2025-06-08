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

            <form action="{{route('profileakdemiksiswa.UpdateDetailSiswa')}}" method="POST" id="personalForm">
                @csrf
                @method('PUT')
                <div class="row">


                    {{-- Baris 1 --}}
                    <div class="col-12 mb-3"> <!-- col-12 agar textarea full width dalam 1 baris -->
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat" id="alamat" rows="5" placeholder="Alamat">{{ $user->userable->alamat }}</textarea>
                            <label for="alamat"><i class="fas fa-home me-2"></i>Alamat</label>
                        </div>
                    </div>

                    {{-- Baris ke 2 --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="nis_nisn" class="form-control"
                                value="{{ $user->userable->nis_nisn }}" placeholder="Enter teacher ID">
                            <label for="no_telp"><i class="fas fa-id-card me-2"></i>NIS/NISN</label>
                        </div>
                    </div>

                    {{-- Baris 3 --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="tanggal_lahir_siswa" class="form-control"
                                value="{{ $user->userable->tanggal_lahir }}" placeholder="Enter teacher ID">
                            <label for="tanggal_lahir_admin"><i class="fas fa-birthday-cake me-2"></i>Tanggal
                                Lahir</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="no_telp" class="form-control"
                                value="{{ $user->userable->no_telp }}" placeholder="Enter teacher ID">
                            <label for="no_telp"><i class="fas fa-phone me-2"></i>No Telepon</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="jenis_kelamin" class="form-select" id="jenis_kelamin">
                                <option value="laki-laki"
                                    {{ $user->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="perempuan"
                                    {{ $user->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            <label for="jenis_kelamin"><i class="fas fa-venus-mars me-2"></i>Jenis
                                Kelamin</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="kelas" class="form-control"
                                value="{{ $user->userable->kelas->nama_kelas }}" placeholder="Enter teacher ID" disabled>
                            <label for="kelas"><i class="fas fa-chalkboard me-2"></i>Kelas</label>

                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="number" name="tahun_masuk" class="form-control"
                                value="{{ $user->userable->tahun_masuk }}" placeholder="Enter teacher ID">
                            <label for="kelas"><i class="fas fa-calendar-alt me-2"></i>Tahun Masuk</label>
                        </div>
                    </div>


                    {{-- End row --}}
                </div>


                {{-- Button --}}
                <div class="row mt-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('dashboardsiswa.index') }}" class="btn btn-danger w-100">
                            <i class="fas fa-arrow-left me-2"></i>Kembali Ke Dashboard
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
