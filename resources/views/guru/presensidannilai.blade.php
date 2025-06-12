@extends('template')

@section('title', 'Nilai Dan Presensi')

@section('sidebar')
    <!-- Sidebar -->
    @include('guru.component.navguru')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <div class="text-center mb-4 pt-2">
                <i class="bi bi-person-check-fill text-primary" style="font-size: 2.5rem;"></i>
                <h3 class="fw-bolder text-dark mt-2 mb-1">Daftar Mata Pelajaran</h3>
                <p class="text-muted fs-6 mb-3">
                    Berikut adalah daftar mata pelajaran
                    <span class="fw-bold text-dark"></span> dan kelas yang anda ampu.
                </p>
            </div>
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
            class="card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-dark fw-bold mb-0 d-flex align-items-center">
                <i class="fas fa-tasks me-2"></i>

            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <div class="col-md-12">
                <ul class="list-group list-group-flush">
                    <!-- FOREACH LOOP DIMULAI DI SINI -->
                    @foreach ($pembelajaran as $pb)
                        <li class="list-group-item p-3 hover-glow mb-2 border"
                            onmouseover="this.classList.add('border-birumantap'); this.querySelector('.hidden-badge').classList.remove('d-none')"
                            onmouseout="this.classList.remove('border-birumantap'); this.querySelector('.hidden-badge').classList.add('d-none')">
                            <a href="{{ route('presensidannilai.show', $pb->id) }}"
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center text-decoration-none text-dark">

                                <!-- Bagian Kiri dengan Icon -->
                                <div class="d-flex align-items-center">
                                    <!-- Icon Subject Area -->
                                    <div class="me-3 text-birumantap">
                                        <i class="fas fa-book-open fs-4"></i>
                                    </div>

                                    <!-- Content -->
                                    <div>
                                        <h6 class="mb-1 fw-semibold" style="font-size: 1rem;">
                                            {{ $pb->mapel->nama_mapel }}
                                        </h6>
                                        <small class="text-muted d-block" style="font-size: 0.8rem;">
                                            <i class="fas fa-users me-1"></i>
                                            Kelas: {{ $pb->kelas->nama_kelas }}
                                        </small>
                                    </div>
                                </div>

                                <!-- Bagian Kanan -->
                                <div class="mt-2 mt-md-0 d-flex align-items-center text-muted" style="font-size: 0.85rem;">
                                    <span class="badge bg-birumantap text-white me-2 d-none hidden-badge">
                                        <i class="fas fa-eye me-1"></i>Lihat Detail
                                    </span>
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Jumlah Pertemuan: {{ $pb->total_pertemuan ?? 'Belum ada pertemuan' }}
                                    <i class="fas fa-chevron-right ms-2"></i>
                                </div>
                            </a>
                        </li>
                    @endforeach

                    <!-- FOREACH LOOP BERAKHIR DI SINI -->
                </ul>
            </div>

        </div>
        <!-- End Card Body -->

    </div>


@endsection
