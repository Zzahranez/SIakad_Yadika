@extends('template')

@section('title', 'Absensi Siswa')

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
            class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-dark fw-bold mb-0 d-flex align-items-center">
                 Absensi Siswa 

            </h4>
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
                                {{ $pertemuan->pembelajaran->kelas->nama_kelas }}</p>
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
                                {{ $pertemuan->pembelajaran->mapel->nama_mapel }}</p>
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
                            <p class="card-text fw-bold fs-5 mb-0 text-info">{{ $pertemuan->tanggal }}</p>
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

            <form action="{{ route('DetailPresensi.PresensiSiswa') }}" method="POST">
                @csrf
                <input type="hidden" name="pertemuan" id="pertemuan-hidden" value="{{ $pertemuan->id }}">

                <!-- Control Section dengan Alert Bootstrap -->
                <div class="alert alert-light border shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-gear-fill text-primary me-2 fs-5"></i>
                        <h6 class="mb-0 fw-bold text-uppercase" style="letter-spacing: 1px;">Kontrol Cepat</h6>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status_all" id="status_all_hadir"
                                value="hadir">
                            <label class="form-check-label fw-semibold" for="status_all_hadir">
                                <i class="bi bi-check-circle-fill text-success me-1"></i>
                                Hadir Semua
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status_all" id="status_all_none"
                                value="" checked>
                            <label class="form-check-label fw-semibold" for="status_all_none">
                                <i class="bi bi-arrow-clockwise text-warning me-1"></i>
                                Reset
                            </label>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table
                        class="table table-striped table-hover align-middle table-borderless mb-0 shadow-sm rounded overflow-hidden">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="px-4 py-3 fw-bold rounded-start">No</th>
                                <th scope="col" class="px-4 py-3 fw-bold">
                                    <i class="bi bi-person-fill me-2"></i>Nama Siswa
                                </th>
                                <th scope="col" class="px-4 py-3 text-center fw-bold rounded-end">
                                    <i class="bi bi-clipboard-check me-2"></i>Status Kehadiran
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr class="bg-white shadow-sm">
                                    <th scope="row" class="px-4">{{ $loop->iteration }}</th>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-white"></i>
                                            </div>
                                            <span class="fw-semibold">{{ $s->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <input type="radio" class="btn-check" name="status[{{ $s->id }}]"
                                                value="hadir" id="hadir_{{ $s->id }}" autocomplete="off">
                                            <label class="btn btn-outline-success" for="hadir_{{ $s->id }}">
                                                <i class="bi bi-check-lg me-1"></i>Hadir
                                            </label>

                                            <input type="radio" class="btn-check" name="status[{{ $s->id }}]"
                                                value="alpa" id="sakit_{{ $s->id }}" autocomplete="off">
                                            <label class="btn btn-outline-danger" for="sakit_{{ $s->id }}">
                                                <i class="bi bi-x-lg me-1"></i>Alpa
                                            </label>

                                            <input type="radio" class="btn-check" name="status[{{ $s->id }}]"
                                                value="izin" id="izin_{{ $s->id }}" autocomplete="off">
                                            <label class="btn btn-outline-warning" for="izin_{{ $s->id }}">
                                                <i class="bi bi-exclamation-lg me-1"></i>Izin
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                    <button type="submit" class="btn bg-birumantap btn-sm px-5 py-3 fw-bold text-uppercase hover-glow text-white"
                        style="letter-spacing: 1px;">
                        <i class="bi bi-save me-2"></i>Simpan Presensi
                    </button>
                </div>
            </form>
 
            <script>
                // Tangkap radio "centang semua" - SCRIPT ASLI TIDAK DIUBAH
                document.querySelectorAll('input[name="status_all"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const value = this.value; // nilai yang dipilih (hadir/sakit/izin atau '')
                        const siswaRadios = document.querySelectorAll('tbody input[type="radio"]');

                        siswaRadios.forEach(radioInput => {
                            if (value === '') {
                                radioInput.checked = false;
                            } else {
                                // Cek radio siswa yang sesuai dengan value centang semua
                                if (radioInput.value === value) {
                                    radioInput.checked = true;
                                } else {
                                    radioInput.checked = false;
                                }
                            }
                        });
                    });
                });
            </script>
        </div>
        <!-- End Card Body-->
    </div>
    <!-- End Card-->

@endsection
