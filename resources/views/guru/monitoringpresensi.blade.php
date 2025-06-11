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
            class="card-header bg-white bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h4 class="text-dark fw-bold mb-0 d-flex align-items-center">
                Tambah Pertemuan Kelas

            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">

            <!-- select kelas -->
            <div class="mb-3">
                <label for="select-kelas" class="form-label fw-semibold">
                    <i class="fas fa-book me-2 text-dark"></i>
                    Pilih Kelas yang Diampu
                </label>
                <select name="kelas_mapel" id="select-kelas" class="form-select overflow-auto">
                    <option value="" selected disabled>Kelas yang diampu</option>
                    @foreach ($guru_mengajar as $ja)
                        <option value="{{ $ja->id }}">
                            {{ $ja->kelas->nama_kelas }} - {{ $ja->mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!--End select kelas -->

            <!-- hidden form -->
            <div class="mt-3" style="display: none;" id="form-pertemuan">
                <div class="card border-0 bg-light bg-opacity-10">
                    <div class="card-header bg-birumantap text-white py-2 mt-3">
                        <h5 class="mb-0 fw-semibold">
                            Tambah Pertemuan
                        </h5>
                    </div>

                    <div class="card-body p-3">
                        <form action="{{ route('monitoringpembelajaran.store') }}" method="POST">
                            @csrf

                            <!-- Hidden Input -->
                            <input type="hidden" name="kelas_mapel" id="hidden-kelas-mapel">

                            <!-- Row 1-->
                            <div class="row align-items-end mb-3">
                                <div class="col-md-8">
                                    <div>
                                        <label for="tanggal" class="form-label fw-semibold">
                                            <i class="fas fa-calendar me-2 text-primary"></i>
                                            Tanggal Pertemuan Kelas
                                        </label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal_pertemuan"
                                            required>
                                    </div>
                                </div>
                                <div class="offset-2 col-md-2">
                                    <button type="button" id="btn-tanggal-sekarang" class="btn btn-outline-secondary w-100"
                                        onclick="isiTanggalHariIni()" aria-label="Isi Tanggal Hari Ini"
                                        title="Isi Tanggal Hari Ini">
                                        <i class="fas fa-calendar-day"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Waktu Pertemuan -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3 mb-md-0">
                                        <label for="jam_mulai" class="form-label fw-semibold">
                                            <i class="fas fa-clock me-2 text-success"></i>
                                            Jam Mulai
                                        </label>
                                        <input type="time" name="jam_mulai" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 mb-md-0">
                                        <label for="jam_selesai" class="form-label fw-semibold">
                                            <i class="fas fa-history me-2 text-danger"></i>
                                            Jam Selesai
                                        </label>
                                        <input type="time" name="jam_selesai" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Materi -->
                            <div class="mb-3">
                                <label for="materi" class="form-label fw-semibold">
                                    <i class="fas fa-book-open me-2 text-info"></i>
                                    Materi Pembelajaran
                                </label>
                                <input type="text" name="materi" class="form-control"
                                    placeholder="Masukkan materi yang akan diajarkan..." required>
                            </div>

                            <hr class="my-3">

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-center">
                                <button class="btn bg-birumantap px-4 py-2 fw-semibold text-white hover-smooth" type="submit">
                                    <i class="fas fa-plus-circle me-2 text-white"></i>
                                    Tambah Pertemuan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End hidden form -->
        </div>
    </div>
    <!-- End Form -->

    <!-- Script Interaktif Form -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //ambil elemen select dan form
            const selek_kelas = document.getElementById('select-kelas');
            const form_pertemuan = document.getElementById('form-pertemuan');
            const hiddenInput = document.getElementById('hidden-kelas-mapel');

            selek_kelas.addEventListener('change', function() {
                if (selek_kelas.value) {
                    hiddenInput.value = selek_kelas.value;
                    form_pertemuan.style.display = 'block';
                } else {
                    hiddenInput.value = '';
                    form_pertemuan.style.display = 'none';
                }
            });
        });

        function isiTanggalHariIni() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const tanggalHariIni = `${yyyy}-${mm}-${dd}`;
            document.getElementById('tanggal_pertemuan').value = tanggalHariIni;
        }
    </script>

    </div>
    <!-- End Card Body-->
    </div>
    <!-- End Card-->

@endsection
