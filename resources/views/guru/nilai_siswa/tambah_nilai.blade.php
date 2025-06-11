@extends('template')

@section('title', 'Tambah nilai')

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
            <a href="{{ route('nilaisiswa.index') }}"
                class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-2 py-1 text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i>
                <span class="fw-semibold"></span>
            </a>

            <div
                class=" ms-2 card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center flex-grow-1">
                <h4 class="text-dark fw-bold mb-0 d-flex align-items-center">
                    Input Nilai Siswa
                </h4>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">

            <!-- Header Info -->
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h5 class="mb-1 text-dark"><i class="fas fa-clipboard-list me-2"></i>Input Nilai Siswa</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <div>
                            <small class="text-muted d-block">Mata Pelajaran</small>
                            <span class="fw-medium">{{ $pertemuan->pembelajaran->mapel->nama_mapel }}</span>
                        </div>
                        <div>
                            <small class="text-muted d-block">Kelas</small>
                            <span class="fw-medium">{{ $pertemuan->pembelajaran->kelas->nama_kelas }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Success -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Input Nilai -->
            <form method="POST" action="{{ route('nilaisiswa.store', $pertemuan->id) }}">
                @csrf

                <!-- Quick Actions -->
                <div class="mb-3">
                    <div class="row g-2">
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="setAllValues(false,100)">
                                <i class="fas fa-star me-1"></i>Set Semua 100
                            </button>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                onclick="setAllValues(false,80)">
                                <i class="fas fa-thumbs-up me-1"></i>Set Semua 80
                            </button>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setAllValues(true)">
                                <i class="fas fa-random me-1"></i>Set Semua Random
                            </button>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="clearAllValues()">
                                <i class="fas fa-eraser me-1"></i>Kosongkan Semua
                            </button>
                        </div>
                    </div>
                </div>

                <!-- List Siswa -->
                <div class="list-group list-group-flush mb-4">
                    @foreach ($pertemuan->presensi as $index => $presensi)
                        <div class="list-group-item border rounded mb-2">
                            <div class="row align-items-center">
                                <div class="col-1 text-center">
                                    <span class="badge bg-secondary">{{ $index + 1 }}</span>
                                </div>
                                <div class="col-md-6 col-lg-7">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initial bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($presensi->siswa->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $presensi->siswa->nama }}</h6>
                                            <small class="text-muted">NIS/NISN:
                                                {{ $presensi->siswa->nis_nisn ?? '-' }}</small>
                                            @php
                                                $warna = match (strtolower($presensi->status)) {
                                                    'alpa' => 'red',
                                                    'izin' => 'orange',
                                                    'hadir' => 'green',
                                                    default => 'black',
                                                };
                                            @endphp
                                            <small class="d-block text-muted">
                                                Presensi :
                                                <span
                                                    style="background-color: {{ $warna }}; padding: 2px 8px; border-radius: 999px;"
                                                    class="text-white">
                                                    {{ $presensi->status }}
                                                </span>

                                            </small>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-4">
                                    <div class="input-group">
                                        <input type="number" name="nilai[{{ $presensi->id }}]" class="form-control"
                                            value="{{ $presensi->nilai }}" min="0" max="100"
                                            placeholder="0-100"
                                            @if (strtolower($presensi->status) === 'alpa') disabled @else data-updatable="true" @endif>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Footer Actions -->
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Total {{ count($pertemuan->presensi) }} siswa
                    </small>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Simpan Nilai
                        </button>
                    </div>
                </div>
            </form>

            <!--Javascript untuk set -->
            <script>
                function setAllValues(random = false, value) {
                    const inputs = document.querySelectorAll('input[data-updatable="true"]');
                    inputs.forEach(input => {
                        if (random) {
                            const randomValue = Math.floor(Math.random() * 100) + 1;
                            input.value = randomValue;
                        } else {
                            input.value = value;
                        }
                    });
                }

                function clearAllValues() {
                    const inputs = document.querySelectorAll('input[type="number"]');
                    inputs.forEach(input => {
                        input.value = '';
                    });
                }
            </script>

        </div>
        <!-- End Card Body -->


    </div>


@endsection
