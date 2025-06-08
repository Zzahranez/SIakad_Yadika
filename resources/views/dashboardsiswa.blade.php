@extends('template')

@section('title', 'Dashboard Siswa')

@section('sidebar')
    @include('siswa.component.navsiswa')
@endsection

@section('titledash')
    <div class="row mb-4 mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-birumantap">Dashboard akademik</h2>
            <p class="text-muted fs-5">
                 Jumpa lagi 
                <span class="fw-semibold text-dark">{{ $nama_user->userable->nama }}!👋</span>
                <br>
                📚 Tahun Akademik {{ $tahun_akademik }} – Semester {{ $semester }}
                {{-- <br>
                                    📅 Data per tanggal: {{ $date }} --}}
            </p>

        </div>
    </div>
@endsection


@section('statscard')

    <!-- Stats Cards -->

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-primary text-white rounded-circle p-3 me-3">
                    <i class="fas fa-graduation-cap fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Nilai Rata-Rata</p>
                    <h3 class="fw-bold mb-0 display-8">{{ $nilairataAll }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-warning text-white rounded-circle p-3 me-3">
                    <i class="fas fa-book fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Pertemuan Berlangsung</p>
                    <h3 class="fw-bold mb-0 display-8 ">{{ $pertemuanberlangsung }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-success text-white rounded-circle p-3 me-3">
                    <i class="fas fa-calendar-check fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Kehadiran</p>
                    <h3 class="fw-bold mb-0 display-8">{{ $kehadiran }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-1 rounded-3 bg-white">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3 text-birumantap">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Mapel & Guru Mengajar
                </h5>

                <div style="max-height: 320px; overflow-y: auto;">
                    @forelse ($gurudanmapel as $gm)
                        <div class="mb-3 p-3 bg-light rounded shadow-md">
                            <div class="fw-semibold text-dark">{{ $gm->mapel->nama_mapel }}</div>
                            <div class="small text-muted mt-1">
                                <i class="fas fa-layer-group me-1"></i>{{ $gm->kelas->nama_kelas }}
                                <br>
                                <i class="fas fa-user-tie me-1"></i>{{ $gm->guru->nama }}
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">Belum ada data mengajar</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow border-1 rounded-3 bg-white hover-smooth pb-5">
            <div class="card-body">
                <canvas id="grafikNilai" style="height: 100vh;"></canvas>
            </div>
        </div>
        <!-- Grafik -->
        @include('cart.siswa.cart_dashboard')
    </div>

    <!-- Pengumuman -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-primary bg-opacity-10 text-primary d-flex align-items-center text">
            <i class="fas fa-bullhorn me-2"></i>
            <strong class="fs-5">Pengumuman</strong>
        </div>
        <div class="card-body">
            <!-- Isi pengumuman -->
            <p class="mb-0">
                Selamat datang di sistem informasi kami! Pastikan Anda memperbarui data secara berkala.
            </p>
        </div>
    </div> 

@endsection
