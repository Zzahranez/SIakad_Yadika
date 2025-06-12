@extends('template')

@section('title', 'Admin Kelola Nilai')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5 mb-3">
        <div class="col text-center">
            <h2 class="fw-bold text-dark">Admin Kelola Nilai</h2>
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
            class="card-header bg-birumantap  bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
                <i class="fas fa-tasks me-2"></i> Daftar Nilai Per Pertemuan

            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <!-- Filter Pertemuan -->
            <div class=" px-4">
                <!-- Form Filter -->
                <form action="{{ route('filter.nilai') }}" method="GET" class="row g-3 mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="siswa_id" class="form-label">Nama Siswa</label>
                            <input type="text" name="siswa_id" class=" form-control" value="{{ request('siswa_id') }}" placeholder="Tanpa Filter">
                        </div>

                        <div class="col-md-3">
                            <label for="guru_id" class="form-label">Guru</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value="">Tanpa Filter</option>
                                @foreach ($guru as $gr)
                                    <option value="{{ $gr->id }}"
                                        {{ request('guru_id') == $gr->id ? 'selected' : '' }}>{{ $gr->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-control">
                                <option value="">Tanpa Filter</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class=" form-control" name="tanggal" value="{{ request('tanggal') }}">
                        </div>
                    </div>


                    <div class="col-md-3 ms-auto d-flex justify-content-end gap-2">
                        <button type="submit" class="btn bg-birumantap text-white hover-smooth w-50">Filter</button>
                        <a href="{{ route('managenilai.index') }}"
                            class="btn btn-secondary text-white hover-smooth w-50">Reset</a>
                    </div>
                </form>

            </div>
            <!-- End Filter Pertemuan -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-borderless mb-0 shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3 rounded-start">Nama</th>
                            <th scope="col" class="px-4 py-3 text-center">Nilai</th>
                            <th scope="col" class="px-4 py-3 text-center">Waktu</th>
                            <th scope="col" class="px-4 py-3 text-center">Kelas</th>
                            <th scope="col" class="px-4 py-3 text-center">Mata Pelajaran</th>
                            <th scope="col" class="px-4 py-3 text-center">Guru Mengajar</th>
                            <th scope="col" class="px-4 py-3 text-center rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="px-4 py-3">{{ $item->siswa->nama }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="badge 
                        @if ($item->nilai >= 85) bg-success-subtle text-success-emphasis
                        @elseif($item->nilai >= 70) bg-warning-subtle text-warning-emphasis
                        @else bg-danger-subtle text-danger-emphasis @endif p-2">
                                        {{ $item->nilai }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">{{ $item->pertemuan->tanggal }} <br>
                                    {{ $item->pertemuan->jam_mulai }} - {{ $item->pertemuan->jam_selesai }}</td>
                                <td class="px-4 py-3 text-center">{{ $item->pertemuan->pembelajaran->kelas->nama_kelas }}
                                </td>
                                <td class="px-4 py-3 text-center">{{ $item->pertemuan->pembelajaran->mapel->nama_mapel }}
                                </td>
                                <td class="px-4 py-3 text-center">{{ $item->pertemuan->pembelajaran->guru->nama }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('managenilai.show', $item->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1 hover-smooth" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Edit</span>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger hover-smooth"
                                        title="Hapus Data {{ $item->siswa->nama }}">
                                        <i class="bi bi-trash"></i> <span class="d-none d-md-inline">Hapus</span>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Card Footer -->
                @include('pagination_footer_card', ['collection' => $data])

            </div>
            <!-- End table responsive-->
        </div>
        <!-- End card body -->

        <!-- Footer Card -->
    </div>
    <!-- End Card-->

@endsection
