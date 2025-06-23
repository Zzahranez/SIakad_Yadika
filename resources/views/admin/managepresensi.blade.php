@extends('template')

@section('title', 'Admin | Presensi')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-dark">Kelola Presensi</h2>
            <p class="text-muted fs-5">Kelola <span class="fw-semibold text-dark">Data Presensi</span></p>
        </div>
    </div>
    @include('session.session_pop')
@endsection

@section('Table')
    <!-- Star Card -->
    <div class="card shadow-lg  border-0 rounded-3">
        <!-- Card Header -->
        <div
            class="card-header bg-birumantap bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
                <i class="fas fa-tasks me-2"></i> Daftar Presensi

            </h4>
            {{-- <button type="button" class="btn btn-light d-flex align-items-center gap-2 hover-smooth" data-bs-toggle="modal"
                data-bs-target="#tambahPembelajaranModal">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah</span>
            </button> --}}
        </div>

        <!-- Card Body -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Filter -->
            <form action="{{ route('managepresensi.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-select" id="kelas" name="kelas">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="guru" class="form-label">Guru</label>
                    <select class="form-select" id="guru" name="guru">
                        <option value="">Semua Guru</option>
                        @foreach ($guru as $guru)
                            <option value="{{ $guru->id }}" {{ request('guru') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal"
                        value="{{ request('tanggal') }}">
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn bg-birumantap text-white hover-smooth">Filter</button>
                    <a href="{{ route('managepresensi.index') }}" class="btn btn-secondary ms-2 hover-smooth">Reset</a>
                </div>
            </form>
            <!-- Form Filter -->

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-borderless mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 rounded-start">No</th>
                            <th scope="col" class="px-4 py-3">Kelas</th>
                            <th scope="col" class="px-4 py-3">Mapel</th>
                            <th scope="col" class="px-4 py-3">Guru</th>
                            <th scope="col" class="px-4 py-3">Tanggal Dan Pertemuan</th>
                            <th scope="col" class="px-4 py-3">Siswa Id</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3 text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ulang Kids -->
                        @foreach ($presensi as $presen)
                            <tr class="bg-white shadow-sm">
                                <th scope="row" class="px-4">{{ $loop->iteration }}</th>
                                <td class="px-4">
                                    {{ $presen->pertemuan->pembelajaran->kelas->nama_kelas }}</td>
                                <td class="px-4">
                                    {{ $presen->pertemuan->pembelajaran->mapel->nama_mapel }}</td>
                                <td class="px-4">{{ $presen->pertemuan->pembelajaran->guru->nama }}
                                </td>
                                <td class="px-4">{{ $presen->pertemuan->tanggal }} <br>
                                    {{ $presen->pertemuan->jam_mulai }} -
                                    {{ $presen->pertemuan->jam_selesai }}</td>
                                <td class="px-4">{{ $presen->siswa->nama }}</td>
                                <td class="px-4">{{ $presen->status }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Tombol aksi">
                                        <button type="button" class="btn btn-sm btn-outline-info px-3"
                                            data-bs-toggle="modal" data-bs-target="#editPresenModal-{{ $presen->id }}"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger px-3"
                                            data-bs-toggle="modal" data-bs-target="#hapusPresensiModal-{{$presen->id}}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Include -->
                            @include('admin.akademik.presensi.modal_edit_presensi')
                            @include('admin.akademik.presensi.modal_destroy_presensi')
                        @endforeach
                        <!--End Ulang-->
                    </tbody>
                </table>
            </div>
        </div>

       @include('pagination_footer_card', [ 'collection' => $presensi])

    </div>
    <!-- End Card -->
@endsection
