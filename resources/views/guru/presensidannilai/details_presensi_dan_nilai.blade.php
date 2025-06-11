@extends('template')

@section('title', 'Nilai Dan Presensi')

@section('sidebar')
    <!-- Sidebar -->
    @include('guru.component.navguru')
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

    <!-- Star Card -->
    <div class="card shadow-lg  border-0 rounded-3">
        <!-- Card Header -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('presensidannilai.index') }}"
                class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-2 py-1 text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i>
                <span class="fw-semibold"></span>
            </a>

            <div
                class=" ms-2 card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center flex-grow-1">
                <h4 class="text-dark fw-bold mb-0 d-flex align-items-center">
                    <i class="fas fa-tasks me-2"></i> Daftar Siswa
                </h4>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <!-- content -->
            <div class="text-center mb-4 pt-2">
                <i class="bi bi-person-check-fill text-primary" style="font-size: 2.5rem;"></i>
                <h3 class="fw-bolder text-dark mt-2 mb-1">Rekap Presensi Siswa</h3>
                <p class="text-muted fs-6 mb-3">
                    Berikut adalah rincian statistik kehadiran dari total
                    <span class="fw-bold text-dark">{{ $totalPertemuan }}</span> pertemuan yang telah dilaksanakan.
                </p>
                <hr class="my-4">
                <!-- StatCard -->
                <div class="row g-3 mt-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-success bg-opacity-10">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="bg-success bg-opacity-25 rounded-circle p-2">
                                        <i class="bi bi-people-fill fs-5 text-success"></i>
                                    </div>
                                    <span class="badge bg-success bg-opacity-25 text-success">Hadir</span>
                                </div>
                                <h4 class="fw-bold text-success mb-1">{{ $totalSiswaHadir }}</h4>
                                <h6 class="text-muted mb-0">Total Seluruh Kehadiran</h6>
                                <small class="text-muted">Siswa yang hadir hari ini</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-danger bg-opacity-10">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="bg-danger bg-opacity-25 rounded-circle p-2">
                                        <i class="bi bi-person-x-fill fs-5 text-danger"></i>
                                    </div>
                                    <span class="badge bg-danger bg-opacity-25 text-danger">Alpa</span>
                                </div>
                                <h4 class="fw-bold text-danger mb-1">{{ $totalSiswaAlpa }}</h4>
                                <h6 class="text-muted mb-0">Total Seluruh Alpa</h6>
                                <small class="text-muted">Siswa tidak hadir tanpa keterangan</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-warning bg-opacity-10">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="bg-warning bg-opacity-25 rounded-circle p-2">
                                        <i class="bi bi-person-check-fill fs-5 text-warning"></i>
                                    </div>
                                    <span class="badge bg-warning bg-opacity-25 text-warning">Izin</span>
                                </div>
                                <h4 class="fw-bold text-warning mb-1">{{ $totalSiswaIzin }}</h4>
                                <h6 class="text-muted mb-0">Total Seluruh Izin</h6>
                                <small class="text-muted">Siswa izin/sakit dengan keterangan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Table-->
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle caption-top bg-light">


                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-start ps-3" style="width: 28%;">
                                    <i class="bi bi-people-fill me-1"></i> Nama Siswa
                                </th>
                                <th scope="col" class="text-center" style="width: 15%;">
                                    <i class="bi bi-calendar-check-fill text-success me-1" title="Hadir"></i> Hadir
                                </th>
                                <th scope="col" class="text-center" style="width: 15%;">
                                    <i class="bi bi-calendar-x-fill text-danger me-1" title="Alpa"></i> Alpa
                                </th>
                                <th scope="col" class="text-center" style="width: 15%;">
                                    <i class="bi bi-calendar-minus-fill text-info me-1" title="Izin"></i> Izin
                                </th>
                                <th scope="col" class="text-center" style="width: 15%;">
                                    <i class="bi bi-calendar-minus-fill text-info me-1" title="Izin"></i> Rata-rata Nilai Pertemuan
                                </th>
                                <th scope="col" class="text-center" style="min-width: 180px;">
                                    <i class="bi bi-pie-chart-fill text-secondary me-1" title="Persentase Hadir"></i>
                                    Persentase Kehadiran
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presensiPerSiswa as $siswaId => $data)
                                <tr>
                                    <td class="text-start ps-3">
                                        <span class="fw-medium">
                                            {{ $data['nama'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill fs-6 px-3 py-2">
                                            {{ $data['hadir'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle rounded-pill fs-6 px-3 py-2">
                                            {{ $data['alpa'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-warning-subtle bg-opacity-10 text-info-emphasis border border-info-subtle rounded-pill fs-6 px-3 py-2">
                                            {{ $data['izin'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-info-subtle bg-opacity-10 text-info-emphasis border border-info-subtle rounded-pill fs-6 px-3 py-2">
                                            {{$data['rata-rata']}}
                                        </span>
                                    </td>
                                    <td class="text-center px-3">
                                        @if ($totalPertemuan > 0)
                                            @php
                                                $persentaseHadir = ($data['hadir'] / $totalPertemuan) * 100;
                                                $persentaseHadirFormatted = number_format($persentaseHadir, 0);
                                                $progressBarColor = 'bg-primary'; // Default color
                                                if ($persentaseHadir < 50) {
                                                    $progressBarColor = 'bg-danger';
                                                } elseif ($persentaseHadir < 75) {
                                                    $progressBarColor = 'bg-warning text-dark'; // text-dark untuk kontras di kuning
                                                } else {
                                                    $progressBarColor = 'bg-success';
                                                }
                                            @endphp
                                            <div class="progress" style="height: 28px; font-size: 0.9rem;"
                                                title="{{ number_format($persentaseHadir, 2) }}% Kehadiran">
                                                <div class="progress-bar progress-bar-animated {{ $progressBarColor }} fw-semibold"
                                                    ясн role="progressbar" style="width: {{ $persentaseHadirFormatted }}%;"
                                                    aria-valuenow="{{ $persentaseHadirFormatted }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $persentaseHadirFormatted }}%
                                                </div>
                                            </div>
                                        @else
                                            <span
                                                class="badge bg-secondary-subtle text-secondary-emphasis border border-secondary-subtle rounded-pill">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="bi bi-clipboard-data" style="font-size: 3.5rem; color: #adb5bd;"></i>
                                        <p class="mb-0 mt-2 fs-5 fw-medium">Oops! Belum Ada Data Presensi.</p>
                                        <p class="small">Statistik kehadiran siswa akan ditampilkan di sini setelah data
                                            tersedia dan diproses.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($totalPertemuan > 0 && count($presensiPerSiswa) > 0)
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-semibold text-secondary-emphasis mb-3"><i class="bi bi-key-fill me-1"></i> Petunjuk
                        Pembacaan Data:</h6>
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <div class="p-2 bg-light-subtle border rounded-2 h-100">
                                <i class="bi bi-calendar-check-fill text-success me-2"></i><span
                                    class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill">Angka</span>
                                <small class="d-block mt-1 text-muted">Menunjukkan total kehadiran siswa.</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="p-2 bg-light-subtle border rounded-2 h-100">
                                <i class="bi bi-calendar-x-fill text-danger me-2"></i><span
                                    class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle rounded-pill">Angka</span>
                                <small class="d-block mt-1 text-muted">Menunjukkan total ketidakhadiran (alpa).</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="p-2 bg-light-subtle border rounded-2 h-100">
                                <i class="bi bi-calendar-minus-fill text-info me-2"></i><span
                                    class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill">Angka</span>
                                <small class="d-block mt-1 text-muted">Menunjukkan total izin yang diajukan.</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="p-2 bg-light-subtle border rounded-2 h-100">
                                <div class="progress d-inline-block me-1 align-middle"
                                    style="height:12px; width: 15px; background-color: #e9ecef;">
                                    <div class="progress-bar bg-success" style="width:100%"></div>
                                </div>
                                <div class="progress d-inline-block me-1 align-middle"
                                    style="height:12px; width: 15px; background-color: #e9ecef;">
                                    <div class="progress-bar bg-warning" style="width:100%"></div>
                                </div>
                                <div class="progress d-inline-block me-2 align-middle"
                                    style="height:12px; width: 15px; background-color: #e9ecef;">
                                    <div class="progress-bar bg-danger" style="width:100%"></div>
                                </div>
                                <small class="d-block mt-1 text-muted">Persentase kehadiran (Hijau: ≥75%, Kuning:
                                    50-74%, Merah: &lt;50%).</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- End Content -->

        </div>
        <!-- End Card Body -->

    </div>


@endsection
