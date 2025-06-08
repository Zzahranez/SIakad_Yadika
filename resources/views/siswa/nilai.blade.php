@extends('template')

@section('title', 'Nilai Pertemuan')

@section('sidebar')
    <!-- Sidebar -->
    @include('siswa.component.navsiswa')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Nilai</h2>
        </div>
    </div>
    {{-- Session --}}
    @include('session.session_pop')

@endsection

@section('Table')

    <!-- Star Card -->
    <div class="card shadow-lg  border-0 rounded-3">
        <!-- Card Header -->
        <div
            class="card-header bg-primary bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                <i class="fas fa-tasks me-2"></i>

            </h4>
        </div>

        <!-- card body -->
        <div class="card-body p-3 p-lg-4">
            <!-- Chart Title & Filter -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <h5 class="text-dark fw-semibold mb-1">Visualisasi Data Pembelajaran</h5>
                    <p class="text-muted small mb-0">Grafik menampilkan distribusi nilai siswa per pertemuan</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" name="chartType" id="btnBar" checked>
                        <label class="btn btn-outline-primary" for="btnBar" onclick="switchChart('bar')">
                            <i class="fas fa-chart-bar me-1"></i>Bar
                        </label>
                        <input type="radio" class="btn-check" name="chartType" id="btnLine">
                        <label class="btn btn-outline-primary" for="btnLine" onclick="switchChart('line')">
                            <i class="fas fa-chart-line me-1"></i>Line
                        </label>

                    </div>
                </div>
            </div>
            
            <!--chart -->
            <div>
                <canvas id="myChart"></canvas>
            </div>

            <!-- Header Section dengan Gradient -->
            <div class="card shadow mt-4 border-0 overflow-hidden">
                <div
                    class="card-body text-center bg-gradient bg-primary text-white fw-bold fs-5 rounded-top d-flex align-items-center justify-content-center gap-2 py-3">
                    <div class="bg-white bg-opacity-25 rounded-circle p-2">
                        <i class="fas fa-calendar-check text-white"></i>
                    </div>
                    <div>
                        Daftar Pertemuan Terbaru
                    </div>
                </div>
            </div>

            <!-- Modern Card Layout -->
            <div class="row mt-3 g-3">
                @foreach ($pertemuan as $index => $pt)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="transition: all 0.3s ease;">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <!-- Icon Section -->
                                    <div class="col-auto">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center"
                                            style="width: 45px; height: 45px;">
                                            <i class="fas fa-book-open text-primary"></i>
                                        </div>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title text-primary mb-0 fw-bold">
                                                {{ $pt->pembelajaran->mapel->nama_mapel }}</h6>
                                            <span
                                                class="badge bg-primary rounded-pill px-2 py-1">{{ $pt->pembelajaran->kelas->nama_kelas }}</span>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center text-muted mb-1">
                                                    <i class="fas fa-calendar-alt me-2 text-secondary small"></i>
                                                    <small>{{ $pt->tanggal }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center text-muted mb-1">
                                                    <i class="fas fa-clock me-2 text-secondary small"></i>
                                                    <small>{{ $pt->jam_mulai }} - {{ $pt->jam_selesai }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-light rounded p-2 mb-2">
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-sticky-note text-warning me-2 mt-1 small"></i>
                                                <div>
                                                    <small class="text-muted fw-semibold">Materi:</small>
                                                    <small class="d-block text-dark">{{ $pt->materi }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Section -->
                                    <div class="col-auto">
                                        <a href="{{ route('nilaiSiswaVisualisasi.show', $pt->id) }}"
                                            class="btn btn-primary btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1">
                                            <i class="fas fa-chart-bar small"></i>
                                            <span class="d-none d-md-inline small">Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Alternatif 7: Number Badge -->
                            <div class="card-footer border-0 bg-transparent text-end py-2 pe-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-circle"
                                    style="width: 25px; height: 25px; line-height: 15px;">
                                    {{ $index + 1 }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Alternative: Grid Layout untuk variasi -->
            <div class="row mt-5 d-none" id="gridView">
                @foreach ($pertemuan as $pt)
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-primary bg-opacity-10 border-0 text-center py-3">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white mb-2"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <h6 class="text-primary fw-bold mb-0">{{ $pt->pembelajaran->mapel->nama_mapel }}</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="badge bg-secondary mb-3 px-3 py-2">
                                    {{ $pt->pembelajaran->kelas->nama_kelas }}
                                </div>
                                <div class="row text-center mb-3">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <i class="fas fa-calendar text-muted mb-1 d-block"></i>
                                            <small class="text-muted">{{ $pt->tanggal }}</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <i class="fas fa-clock text-muted mb-1 d-block"></i>
                                        <small class="text-muted">{{ $pt->jam_mulai }}-{{ $pt->jam_selesai }}</small>
                                    </div>
                                </div>
                                <p class="card-text text-muted small">{{ Str::limit($pt->materi, 80) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center pb-3">
                                <a href="{{ route('nilaiSiswaVisualisasi.show', $pt->id) }}"
                                    class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--end card body -->
        <!--end card body -->

    </div>
    <!-- End Card-->

    <!-- Grafik -->
    @include('siswa.nilai.barcart_nilai')


@endsection
