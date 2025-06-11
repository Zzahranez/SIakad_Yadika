@extends('template')

@section('title', 'Guru | Nilai Siswa')

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
        <div
            class="card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-dark fw-bold mb-0 d-flex align-items-center">Pertemuan terakhir yang dilaksanakan
            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Layout Vertikal Compact Tanpa Border -->
            <div class="list-group list-group-flush">
                @foreach ($pertemuan as $pt)
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-start">
                        <div class="me-auto">
                            <div class="fw-bold text-dark">{{ $pt->pembelajaran->mapel->nama_mapel }}</div>
                            <div class="mb-1">
                                <span class="badge bg-secondary me-2">{{ $pt->pembelajaran->kelas->nama_kelas }}</span>
                                <span class="text-muted">{{ $pt->tanggal }} | {{ $pt->jam_mulai }} -
                                    {{ $pt->jam_selesai }}</span>
                            </div>
                            <div class="text-muted">{{ $pt->materi }}</div>
                        </div>
                        <a href="{{ route('nilaisiswa.showTambahNilai', $pt->id) }}"
                            class="btn btn-sm btn-primary ms-2 hover-smooth">
                            <i class="fas fa-edit"></i>Input/Edit Nilai
                        </a>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
        <!-- End card body -->

    </div>
    <!-- End Card-->

@endsection
