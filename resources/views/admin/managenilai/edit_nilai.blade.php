@extends('template')

@section('title', 'Admin Kelola Nilai')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Edit nilai</h2>
        </div>
    </div>
    {{-- Session --}}
    @include('session.session_pop')

@endsection

@section('Table')

    <!-- Star Card -->
    <div class="card shadow-lg  border-0 rounded-3">
        <!-- Card Header -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('managenilai.index')}}"
                class="btn btn-outline-primary btn-sm rounded-pill shadow-sm px-2 py-1 text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i>
                <span class="fw-semibold"></span>
            </a>

            <div
                class=" ms-2 card-header bg-primary bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center flex-grow-1">
                <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-tasks me-2"></i> Data Pertemuan
                </h4>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">

            <div class="container-fluid mt-4">
                <form action="{{ route('managenilai.update', $data->id) }}" method="POST"> {{-- Ganti dengan route Anda --}}
                    @csrf
                    @method('PUT') {{-- Atau PATCH --}}

                    <div class="row">
                        <div class="col-md-7 col-lg-8">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Informasi Detail</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="card p-3 h-100">
                                                <h5>Siswa</h5>
                                                <hr>
                                                <p><strong>Nama Siswa :</strong> {{ $data->siswa->nama }}</p>
                                                <p><strong>NIS/NISN :</strong> {{ $data->siswa->nis_nisn }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="card p-3 h-100">
                                                <h5>Pertemuan</h5>
                                                <hr>
                                                <p><strong>Kelas :</strong>
                                                    {{ $data->pertemuan->pembelajaran->kelas->nama_kelas }}</p>
                                                <p><strong>Mata Pelajaran :</strong>
                                                    {{ $data->pertemuan->pembelajaran->mapel->nama_mapel }}</p>
                                                <p><strong>Guru Mengajar :</strong>
                                                    {{ $data->pertemuan->pembelajaran->guru->nama }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="card p-3 h-100">
                                                <h5>Jadwal</h5>
                                                <hr>
                                                <p><strong>Tanggal :</strong> {{ $data->pertemuan->tanggal }}</p>
                                                <p><strong>Jam Mulai :</strong> {{ $data->pertemuan->jam_mulai }}</p>
                                                <p><strong>Jam Selesai :</strong> {{ $data->pertemuan->jam_selesai }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                        <div class="col-md-5 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Nilai</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="nilai" class="form-label">Nilai</label>
                                        <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                            name="nilai" id="nilai" value="{{ old('nilai', $data->nilai) }}"
                                            placeholder="Masukkan nilai" required min="0" max="100">
                                        @error('nilai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Batal</a>
                                        {{-- Atau route ke halaman daftar nilai --}}
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    Pastikan nilai yang dimasukkan sudah benar.
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
