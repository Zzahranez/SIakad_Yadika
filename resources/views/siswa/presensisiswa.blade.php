@extends('template')

@section('title', 'Details')

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

    <!-- Star Card -->
    <div class="card shadow-lg  border-0 rounded-3 hover-smooth">
        <!-- Card Header -->
        <div
            class="card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-whie fw-bold mb-0 d-flex align-items-center">
            </h4>
        </div>

        <!-- card body -->
        <div class="card-body p-3 p-lg-4">

            <div class="mb-3 text-center">
                <h4 class="card-title mb-2 fw-bold text-dark"> <i class="bi bi-collection-fill me-2"></i>Ringkasan
                    Kehadiran per Mata Pelajaran
                </h4>
                <p class="fs-6 text-muted mb-0">Berikut adalah rincian kehadiran Anda untuk setiap mata pelajaran yang
                    diikuti.</p>
            </div>
            <hr class="my-4">

            <div class="table-responsive">
                <table class="table table-md table-hover table-striped align-middle mb-0">
                    <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1"
                                style="width: 28%;">
                                Mata Pelajaran
                            </th>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1"
                                style="width: 22%;">
                                Guru Pengajar
                            </th>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1 text-center">
                                Jml Pert.
                            </th>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1 text-center">
                                Hadir
                            </th>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1 text-center">
                                Alpa
                            </th>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1 text-center">
                                Izin
                            </th>
                            <th class="px-3 fw-bold text-secondary text-uppercase fs-7 letter-spacing-1 text-center"
                                style="width: 15%;">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembelajaran as $pb)
                            <tr>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-subtle text-primary-emphasis rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 30px; height: 30px; min-width:30px;">
                                            <i class="bi bi-journal-richtext" style="font-size: 0.85rem;"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold d-block text-dark"
                                                style="font-size: 0.875rem; line-height: 1.4;">{{ $pb->mapel->nama_mapel }}</span>
                                            @if (!empty($pb->mapel->kode_mapel))
                                                <small class="text-muted opacity-75" style="font-size: 0.75rem;">Kode:
                                                    {{ $pb->mapel->kode_mapel }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info-subtle text-info-emphasis rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 30px; height: 30px; min-width:30px;">
                                            <i class="bi bi-person-video3" style="font-size: 0.85rem;"></i>
                                        </div>
                                        <div>
                                            <span class="fw-medium d-block"
                                                style="font-size: 0.875rem; line-height: 1.4;">{{ $pb->guru->nama }}</span>
                                            @if (!empty($pb->guru->nip))
                                                <small class="text-muted opacity-75" style="font-size: 0.75rem;">NIP:
                                                    {{ $pb->guru->nip }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark border rounded-pill px-2 py-1"
                                        style="font-size: 0.75rem;"
                                        title="Total {{ $pb->pertemuan->count() }} sesi pertemuan">
                                        {{ $pb->pertemuan->count() }}
                                    </span>
                                </td>
                                <td class="px-3 text-center">
                                    <span
                                        class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill px-2 py-1"
                                        style="font-size: 0.75rem;" title="{{ $pb->hadir }} kali hadir">
                                        {{ $pb->hadir }}
                                    </span>
                                </td>
                                <td class="px-3 text-center">
                                    <span
                                        class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle rounded-pill px-2 py-1"
                                        style="font-size: 0.75rem;" title="{{ $pb->alpa }} kali alpa">
                                        {{ $pb->alpa }}
                                    </span>
                                </td>
                                <td class="px-3 text-center">
                                    <span
                                        class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1"
                                        style="font-size: 0.75rem;" title="{{ $pb->izin }} kali izin">
                                        {{ $pb->izin }}
                                    </span>
                                </td>
                                <td class="px-3 text-center">
                                    <a href="{{ route('presensisiswa.details', $pb->id) }}"
                                        class="btn btn-outline-primary btn-sm rounded-pill px-2 hover-smooth"
                                        style="padding-top: 0.15rem; padding-bottom: 0.15rem; font-size: 0.75rem;"
                                        title="Lihat Detail Kehadiran untuk {{ $pb->mapel->nama_mapel }}">
                                        <i class="bi bi-search"
                                            style="font-size: 0.8rem; margin-right: 0.15rem !important;"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-folder2-open text-primary" style="font-size: 2.5rem;"></i>
                                        <p class="mb-0 mt-2 fs-6 fw-bold text-primary">Data Tidak Ditemukan</p>
                                        <p class="text-muted small mt-1">Saat ini belum ada data pembelajaran dan kehadiran
                                            yang tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!--end card body -->
    </div>
    <!-- End Card-->

@endsection
