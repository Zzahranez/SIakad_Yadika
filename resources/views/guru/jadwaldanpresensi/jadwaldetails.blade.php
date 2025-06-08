@extends('template')

@section('title', 'Details Pertemuan')

@section('sidebar')
    <!-- Sidebar -->
    @include('guru.component.navguru')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Details Pertemuan</h2>
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
            <a href="{{ route('JadwalPresensiGuru.index') }}"
                class="btn btn-outline-primary btn-sm rounded-pill shadow-sm px-2 py-1 text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i>
                <span class="fw-semibold"></span>
            </a>

            <div
                class=" ms-2 card-header bg-primary bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center flex-grow-1">
                <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-tasks me-2"></i> Daftar Siswa
                </h4>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <!-- Info Section dengan Bootstrap Cards -->
            <div class="row mb-4">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-building text-white fs-4"></i>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted text-uppercase fw-bold"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Kelas</h6>
                            <p class="card-text fw-bold fs-5 mb-0 text-primary">
                                {{ $pertemuan->pembelajaran->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-book text-white fs-4"></i>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted text-uppercase fw-bold"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Mata Pelajaran</h6>
                            <p class="card-text fw-bold fs-5 mb-0 text-success">
                                {{ $pertemuan->pembelajaran->mapel->nama_mapel ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-calendar-event text-white fs-4"></i>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted text-uppercase fw-bold"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Tanggal</h6>
                            <p class="card-text fw-bold fs-5 mb-0 text-info">
                                {{ \Carbon\Carbon::parse($pertemuan->tanggal)->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-lightbulb text-white fs-4"></i>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted text-uppercase fw-bold"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Materi</h6>
                            <p class="card-text fw-bold fs-5 mb-0 text-warning">{{ $pertemuan->materi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Section untuk Daftar Presensi -->
            <div class="alert alert-light border shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-clipboard-check-fill text-primary me-2 fs-4"></i>
                    <h4 class="mb-0 fw-bold text-uppercase" style="letter-spacing: 1px;">Daftar Presensi Siswa</h4>
                </div>
            </div>

            <!-- Tabel Presensi dengan Modern Style -->
            <form action="{{ route('jadwaldanpresensi.updatePresensi', $pertemuan->id) }}" method="POST">
                <div class="table-responsive">
                    <table
                        class="table table-striped table-hover align-middle table-borderless mb-0 shadow-sm rounded overflow-hidden">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="px-4 py-3 fw-bold rounded-start">
                                    <i class="bi bi-person-fill me-2"></i>Nama Siswa
                                </th>
                                <th scope="col" class="px-4 py-3 text-center fw-bold rounded-end">
                                    <i class="bi bi-clipboard-data me-2"></i>Status Kehadiran
                                </th>
                            </tr>
                        </thead>

                        @csrf
                        @method('PUT')

                        <tbody>
                            @foreach ($pertemuan->pembelajaran->kelas->siswa as $siswa)
                                <tr class="bg-white shadow-sm">
                                    <td class="px-4">
                                        {{-- <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-white"></i>
                                            </div>
                                            <span class="fw-semibold">{{ $siswa->nama }}</span>
                                        </div> --}}
                                        <div class="d-flex align-items-center gap-2">
                                            <!-- Bulatan gambar profil siswa -->
                                            <img src="{{ asset('storage/profile_siswa/' . ($siswa->foto_profile ? $siswa->foto_profile : 'default-profile.jpg')) }}"
                                                alt="Foto {{ $siswa->nama }}" class="rounded-circle flex-shrink-0"
                                                style="width: 36px; height: 36px; object-fit: cover;">

                                            <!-- Nama siswa -->
                                            <span class="fw-semibold text-dark">{{ $siswa->nama }}</span>
                                        </div>

                                    </td>
                                    <td class="px-4 text-center">
                                        @php
                                            // Ambil status presensi kalau ada, kalau belum ada null
                                            $currentStatus = $presensi[$siswa->id]->status ?? null;
                                        @endphp

                                        <div class="btn-group btn-group-sm" role="group">
                                            @foreach (['hadir' => 'success', 'alpa' => 'danger', 'izin' => 'warning'] as $status => $color)
                                                <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                                    id="presensi_{{ $siswa->id }}_{{ $status }}"
                                                    value="{{ $status }}" autocomplete="off"
                                                    {{ $currentStatus === $status ? 'checked' : '' }}>
                                                <label class="btn btn-outline-{{ $color }}"
                                                    for="presensi_{{ $siswa->id }}_{{ $status }}">
                                                    @if ($status === 'hadir')
                                                        <i class="bi bi-check-lg me-1"></i>
                                                    @elseif ($status === 'alpa')
                                                        <i class="bi bi-x-lg me-1"></i>
                                                    @elseif ($status === 'izin')
                                                        <i class="bi bi-exclamation-lg me-1"></i>
                                                    @endif
                                                    {{ ucfirst($status) }}
                                                </label>
                                            @endforeach
                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3 text-end">

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-1"></i> Edit Presensi
                        </button>
                    </div>
            </form>
        </div>
        <!--End Info Section dengan Bootstrap Cards -->
    </div>
    <!-- End Card Body-->
    </div>
    <!-- End Card-->
@endsection
