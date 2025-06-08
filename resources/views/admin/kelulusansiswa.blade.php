@extends('template')
@section('title', 'Luluskan Siswa')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Luluskan Siswa</h2>
        </div>
    </div>
    {{-- Session --}}
    @include('session.session_pop')

@endsection

@section('Table')
    {{-- Luluskan Siswa --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Start Card --}}
                <div class="card shadow-lg border-0 rounded-3">
                    <!-- Card Header -->
                    <div
                        class="card-header bg-primary bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="fas fa-graduation-cap me-2"></i> Luluskan Siswa
                        </h4>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('kelulusansiswashow') }}" method="GET" class="mb-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="kelas_id_for_lulus" class="form-label">Pilih Kelas:</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="kelas_id_for_lulus" id="kelas_id_for_lulus" class="form-select">
                                        <option value="" selected disabled>Pilih Kelas</option>
                                        @foreach ($kelas_all as $k)
                                            <option value="{{ $k->id }}"
                                                {{ request('kelas_id_for_lulus') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search me-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if ($siswa->isNotEmpty())
                            <form action="{{ route('manageuser.luluskanSiswa') }}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle table-borderless mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="px-4">
                                                    <input type="checkbox" id="checkAll" title="Pilih Semua"
                                                        class="form-check-input">
                                                </th>
                                                <th scope="col" class="px-4">No</th>
                                                <th scope="col" class="px-4">Nama Siswa</th>
                                                <th scope="col" class="px-4">NIS/NISN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $index => $s)
                                                <tr class="bg-white shadow-sm">
                                                    <td class="px-4">
                                                        <input type="checkbox" name="cekboxsiswa[]"
                                                            class="siswa-checkbox form-check-input"
                                                            value="{{ $s->id }}">
                                                    </td>
                                                    <td class="px-4">{{ $index + 1 }}</td>
                                                    <td class="px-4">{{ $s->nama }}</td>
                                                    <td class="px-4">{{ $s->nis_nisn }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">
                                    <i class="fas fa-check-circle me-1"></i> Luluskan
                                </button>
                            </form>
                        @elseif (request('kelas_id_for_lulus'))
                            <div class="alert alert-warning mt-4" role="alert">
                                Tidak ada siswa di kelas ini.
                            </div>
                        @endif
                    </div>
                </div>
                {{-- End Card --}}

                <script>
                    document.getElementById('checkAll').addEventListener('change', function() {
                        document.querySelectorAll('.siswa-checkbox').forEach(cb => cb.checked = this.checked);
                    });
                </script>

            </div>
        </div>
    </div>
@endsection
