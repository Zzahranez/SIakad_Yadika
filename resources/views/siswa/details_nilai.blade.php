@extends('template')

@section('title', 'Details nilai')

@section('sidebar')
    <!-- Sidebar -->
    @include('siswa.component.navsiswa')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <h2 class="fw-bold text-primary"></h2>
        </div>
    </div>
    {{-- Session --}}
    @include('session.session_pop')

@endsection

@section('Table')

    <!-- Card -->
    <div class="card shadow-lg  border-0 rounded-3">
        <!-- Card Header -->
        <!-- Card Header -->
        <div class="d-flex align-items-center mb-3 mt-2">
            <a href="{{ route('nilaiSiswaVisualisasi.index') }}"
                class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-2 py-1 text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i>
                <span class="fw-semibold"></span>
            </a>

            <div
                class=" ms-2 card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center flex-grow-1">
                <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
          
                </h4>
            </div>
        </div>
        <div class="row mt-2 mb-3">
            <div class="col text-start">
                <h2 class="fw-bold text-dark">Details Nilai</h2>
            </div>
        </div>
        <!-- card body -->
        <div class="card-body p-3 p-lg-4">
            <!--Stats Card -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow border-1 rounded-3 p-3 bg-white hover-smooth">
                        <div class="d-flex align-items-center">
                            <div class="icon text-white rounded-circle p-2 me-3" style="background-color: #003f5c;">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div>
                                <h6 class="text-secondary">Guru Mengajar</h6>
                                <h5 class="fw-bold text-dark">{{ $pertemuan->pembelajaran->guru->nama }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow border-1 rounded-3 p-3 bg-white hover-smooth">
                        <div class="d-flex align-items-center">
                            <div class="icon text-white rounded-circle p-2 me-3" style="background-color: #72a5bc;">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h6 class="text-secondary">Kelas</h6>
                                <h5 class="fw-bold text-dark">{{ $pertemuan->pembelajaran->kelas->nama_kelas }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow border-1 rounded-3 p-3 bg-white hover-smooth">
                        <div class="d-flex align-items-center">
                            <div class="icon text-white rounded-circle p-2 me-3" style="background-color: #36596a;">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h6 class="text-secondary">Tanggal</h6>
                                <h5 class="fw-bold text-dark">{{ $pertemuan->tanggal }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow border-1 rounded-3 p-3 bg-white hover-smooth">
                        <div class="d-flex align-items-center">
                            <div class="icon  text-white rounded-circle p-2 me-3" style="background-color: #6394ab;">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div>
                                <h6 class="text-secondary">Total hadir</h6>
                                <h5 class="fw-bold text-dark">{{ $siswa_hadir }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats Card -->

            <!--cart -->
            <div>
                <canvas id="myChart"></canvas>
            </div>


            <!--End Layout -->
        </div>
        <!--end card body -->

    </div>
    <!-- End Card-->

    <!-- Grafik -->
    @include('siswa.nilai.barcart_nilai_detail')

@endsection
