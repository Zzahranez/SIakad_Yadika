@extends('template')

@section('title', 'Yadika | Guru')

@section('sidebar')
    {{-- Sidebar --}}
    @include('guru.component.navguru')
@endsection

@section('titledash')
    <div class="row mb-4 mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-dark">Dashboard Guru</h2>
            <p class="text-muted fs-5">Selamat datang {{ $nama_user->userable->jenis_kelamin == 'laki-laki' ? 'Pak' : 'Bu' }}
                <span class="fw-semibold text-dark">{{ $nama_user->userable->nama }}</span>
                <br>
                📚 Tahun Akademik {{ $tahun_akademik }}, Semester {{ $semester }}

            </p>
        </div>
    </div>
@endsection

@section('statscard')


    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-primary text-white rounded-circle p-3 me-3">
                    <i class="fas fa-graduation-cap fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Presentase keseluruhan nilai siswa per pertemuan</p>
                    <h3 class="fw-bold mb-0 display-8">{{ $presentase_nilaiSiswa }} %</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-warning text-white rounded-circle p-3 me-3">
                    <i class="fas fa-book fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Pertemuan berlangsung yang yang anda ajar</p>
                    <h3 class="fw-bold mb-0 display-8 ">{{ $jmlh_pertemuan }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="icon-square bg-success text-white rounded-circle p-3 me-3">
                    <i class="fas fa-calendar-check fs-4"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small">Presentase seseluruhan kehadiran siswa per pertemuan</p>
                    <h3 class="fw-bold mb-0 display-8">{{ $presentase_kehadiran }}%</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- @foreach ($labels_pie as $s)
            <p>{{$s['mapel']}} : {{$s['Rata-rata']}}</p>
    @endforeach --}}

    <div class="col-md-8">
        <div class="card shadow border-1 rounded-3 bg-white hover-smooth pb-5">
            <div class="card-body">
                <canvas id="myPieChart" style="height: 48vh;"></canvas>
            </div>
        </div>
        <!-- Grafik pie chart -->
        @include('guru.graph.piechart')
    </div>

    <div class="col-md-4">
        <div class="card shadow border-1 rounded-3 bg-white">
            <div class="card-body">
                <h5 class="card-title text-dark mb-3 text-birumantap">
                    Nilai pertemuan
                    siswa teringgi terbaru
                </h5>

                <div style="max-height: 320px; overflow-y: auto;">
                    @foreach ($nilai as $item)
                        <div class="mb-3 p-3 bg-light rounded shadow-sm">
                            <div class="fw-semibold text-dark mb-2">{{ $item->siswa->nama }}</div>
                            <div class="small text-muted">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-book me-2" style="width: 20px;"></i>
                                    <span>{{ $item->pertemuan->pembelajaran->mapel->nama_mapel }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-user-graduate me-2" style="width: 20px;"></i>
                                    <span>Nilai: {{ $item->nilai }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chalkboard me-2" style="width: 20px;"></i>
                                    <span>{{ $item->pertemuan->pembelajaran->kelas->nama_kelas }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow border-1 rounded-3 bg-white hover-smooth pb-5">
            <div class="card-body">
                <canvas id="myChart" style="height: 100vh;"></canvas>
            </div>
        </div>
        <!-- Grafik pie chart -->
        @include('guru.graph.liniecart')
    </div>

    <!-- Pengumuman -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-white bg-opacity-10 text-dark d-flex align-items-center text">
            <i class="fas fa-bullhorn me-2"></i>
            <strong class="fs-5">Pengumuman</strong>
        </div>
        <div class="card-body">
            <!-- Isi pengumuman -->
            <p class="mb-0">
                @if ($pengumuman->count() > 0)
                    @foreach ($pengumuman as $pm)
                        <div class="bg-white rounded p-3 mb-3 shadow-sm border-start border-4 border-grey">
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

                        </div>
                    @endforeach
                @endif
            </p>
        </div>
    </div>
@endsection
