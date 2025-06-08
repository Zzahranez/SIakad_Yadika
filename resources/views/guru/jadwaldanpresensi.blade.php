@extends('template')

@section('title', 'Jadwa Mengajar | Presensi Kelas')

@section('sidebar')
    <!-- Sidebar -->
    @include('guru.component.navguru')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Monitoring Nilai Dan Presensi</h2>
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
                <i class="fas fa-tasks me-2"></i> Jadwal Mengajar Guru

            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <div class="row g-3">
                {{-- Jadwal Mengajar --}}
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white fw-bold">
                            Jadwal Mengajar
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group list-group-flush">
                                @foreach ($pembelajaran as $pb)
                                    <li class="list-group-item d-flex align-items-center gap-3 py-2"
                                        style="font-family: Arial, sans-serif;">

                                        <!-- Info Mapel dan Kelas di kanan -->
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" style="font-size: 15px; font-weight: 600;">
                                                {{ $pb->mapel->nama_mapel }}</h6>
                                            <small class="text-muted d-block" style="font-size: 12px;">Kelas:
                                                {{ $pb->kelas->nama_kelas }}</small>
                                            <small class="text-muted" style="font-size: 12px;">Jumlah Pertemuan:
                                                {{ $pb->pertemuan_count }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            @include('pagination_footer_card', ['collection' => $pembelajaran])
                        </div>
                    </div>
                </div>

                {{-- Pertemuan --}}
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white fw-bold">
                            Pertemuan
                        </div>
                        <div class="card-body p-3">
                            @if ($pertemuan->count())
                                <ul class="list-group list-group-flush">
                                    @foreach ($pertemuan as $pt)
                                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                                            {{-- <div class="flex-shrink-0">
                                                <span class="badge bg-primary rounded-circle fw-bold"
                                                    style="width: 40px; height: 40px; display: flex; justify-content:center; align-items:center;">
                                                    {{ collect(explode(' ', $pt->pembelajaran->kelas->nama_kelas))->take(2)->map(fn($word) => strtoupper(substr($word, 0, 1)))->implode('') }}
                                                </span>
                                            </div> --}}

                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold">{{ $pt->materi }}</h6>
                                                <small class="text-muted">
                                                    <i
                                                        class="fas fa-book me-1"></i>{{ $pt->pembelajaran->mapel->nama_mapel }}
                                                    •
                                                    <i
                                                        class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($pt->tanggal)->format('d M Y') }}
                                                </small>
                                            </div>

                                            <div class="flex-shrink-0">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('jadwaldanpresensi.show', $pt->id) }}"
                                                        class="btn btn-outline-primary hover-smooth">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger hover-smooth"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $pt->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Modal Simple -->
                                        <div class="modal fade" id="deleteModal{{ $pt->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Hapus Data</h6>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <i class="fas fa-exclamation-triangle text-warning mb-2"
                                                            style="font-size: 2rem;"></i>
                                                        <p class="mb-1">Yakin hapus <strong>{{ $pt->materi }}</strong>?
                                                        </p>
                                                        <small class="text-muted">Data tidak dapat dikembalikan</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('jadwaldanpresensi.destroyPertemuan', $pt->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted fst-italic">Belum ada pertemuan tersedia.</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- End Card Body-->
    </div>
    <!-- End Card-->

@endsection
