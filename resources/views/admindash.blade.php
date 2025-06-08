@extends('template')

@section('title', 'AdminDash')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')

@endsection

@section('titledash')

    <div class="row mb-1 mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Admin Dashboard</h2>
            <p class="text-muted fs-5">Selamat datang, <span class="fw-semibold text-dark">{{ $admin->userable->nama }}</span>
                <br>
                📚 Tahun Akademik {{ $tahun_akademik }}, Semester {{ $semester }}
            </p>
        </div>
    </div>
@endsection

{{-- <div class="col-md-4">
        <div class="card shadow border-1 rounded-3 bg-white">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3 text-birumantap">
                    <i class="fas fa-users me-2"></i>
                    Siswa Terbaru
                </h5>

                <div style="max-height: 320px; overflow-y: auto;">
              
                        <div class="mb-3 p-3 bg-light rounded shadow-sm">
                            <div class="fw-semibold text-dark mb-2"></div>
                            <div class="small text-muted">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-book me-2" style="width: 20px;"></i>
                                    <span></span>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-user-graduate me-2" style="width: 20px;"></i>
                                    <span> </span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chalkboard me-2" style="width: 20px;"></i>
                                    <span></span>
                                </div>
                            </div>
                        </div>
              
                </div>
            </div>
        </div>
    </div> --}}

@section('statscard')

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-primary text-white rounded-circle p-3 me-3">
                    <i class="fas fa-graduation-cap fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Jumlah Siswa</p>
                    <h3 class="fw-bold mb-0 display-8">{{ $jumlahSiswa }}</h3>
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
                    <p class="text-secondary mb-1 small">Presentase Kehadiran Siswa</p>
                    <h3 class="fw-bold mb-0 display-8 ">{{ $presentaseKehadiran }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-success text-white rounded-circle p-3 me-3">
                    <i class="fas fa-person-chalkboard fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Jumlah guru</p>
                    <h3 class="fw-bold mb-0 display-8">{{ $jumlahguru }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="col-md-8">
        <div class="card shadow border-1 rounded-3 bg-white hover-smooth pb-5">
            <div class="card-body">
                <canvas id="myPieChart" style="height: 48vh;"></canvas>
            </div>
        </div>
        <!-- Grafik pie chart -->
        @include('admin.graph.piecart_gender')
    </div>

    <div class="col-md-4">
        <div class="card shadow border-1 rounded-3 bg-white">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3 text-birumantap">
                    <i class="fas fa-users me-2"></i>
                    Siswa Terbaru
                </h5>

                <div style="max-height: 320px; overflow-y: auto;">
                    @foreach ($siswaterbaru as $sn)
                        <div class="mb-3 p-3 bg-light rounded shadow-sm">
                            <div class="fw-semibold text-dark mb-2"></div>
                            <div class="small text-muted">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-user me-2" style="width: 20px;"></i>
                                    <span>{{ $sn->nama }}</span>
                                </div>

                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-id-card me-2" style="width: 20px;"></i>
                                    <span>{{ $sn->nis_nisn }}</span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-2" style="width: 20px;"></i>
                                    <span>{{ $sn->alamat }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- End Row 2 -->

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
