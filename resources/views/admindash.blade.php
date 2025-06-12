@extends('template')

@section('title', 'AdminDash')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')

@endsection

@section('titledash')

    <div class="row mb-1 mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-dark">Admin Dashboard</h2>
            <p class="text-muted fs-5">Selamat datang, <span class="fw-semibold text-dark">{{ $admin->userable->nama }}</span>
                <br>
                📚 Tahun Akademik {{ $tahun_akademik }}, Semester {{ $semester }}
            </p>
        </div>
    </div>
    @include('session.session_pop')
@endsection



@section('statscard')

    <div class="col-12 col-sm-6 col-lg-6 mb-3">
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
  
    <div class="col-12 col-sm-6 col-lg-6 mb-3">
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
                <h5 class="card-title text-dark mb-3 text-birumantap">
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
        <div class="card-header bg-white bg-opacity-10 text-dark d-flex align-items-center">
            <i class="fas fa-bullhorn me-2"></i>
            <strong class="fs-5">Pengumuman</strong>

            <button type="button" class="btn btn-light d-flex align-items-center gap-2 ms-auto" data-bs-toggle="modal"
                data-bs-target="#tambahPengumuman">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah</span>
            </button>
        </div>


        <div class="card-body">
            <!-- Isi pengumuman -->
            <p class="mb-0">
                @if ($pengumuman->count() > 0)
                    @foreach ($pengumuman as $pm)
                        <div class="bg-white p-3 mb-3 shadow-sm border-start border-4 border-grey">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="h6 mb-1 fw-bold text-dark">
                                    <i class="fas fa-info-circle text-primary me-1"></i>
                                    {!! $pm->title !!}
                                </div>
                                <span class="badge bg-secondary">{{ $pm->admin->nama }}</span>
                            </div>
                            <div class="text-muted mb-2 lh-base">
                                {!! Str::limit($pm->isi, 150) !!}
                                @if (strlen($pm->isi) > 150)
                                    <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                        data-bs-target="#detailPengumuman{!! $pm->id !!}">
                                        Baca selengkapnya...
                                    </a>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between small text-muted">
                                <span>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $pm->created_at->format('d M Y') }}
                                </span>
                                <span>
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $pm->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="btn-group mt-2 p-3" role="group" aria-label="Tombol aksi">
                                <button type="button" class="btn btn-sm btn-outline-info px-3" data-bs-toggle="modal"
                                    data-bs-target="#editPengumuman-{{$pm->id}}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger px-3" data-bs-toggle="modal"
                                    data-bs-target="#hapusPengumuman-{{$pm->id}}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Modal -->
                        @include('admin.pengumuman.modal_destroy_pengumuman')
                        @include('admin.pengumuman.modal_edit_pengumuman')
                    @endforeach
                @endif
            </p>
        </div>
    </div>


@endsection

@include('admin.pengumuman.modal_tambah_pengumuman')
