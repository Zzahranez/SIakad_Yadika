@extends('template')

@section('title', 'Admin | Mata Pelajaran')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Kelola Proses Pembelajaran</h2>
            <p class="text-muted fs-5">Kelola <span class="fw-semibold text-dark">Data Akademik</span> Pembelajaran</p>
        </div>
    </div>
    @include('session.session_pop')
@endsection



@section('Table')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs mb-1" id="pembelajaranTabs" role="tablist">
                    <li class="nav-guru" role="presentation">
                        <button class="nav-link active text-dark" id="pembelajaranDaftarTab-tab" data-bs-toggle="tab"
                            data-bs-target="#pembelajaranDaftarTab" type="button" role="tab"
                            aria-controls="pembelajaranDaftarTab" aria-selected="true">
                            <i class="fas fa-book-reader me-2"></i>Guru Mengajar
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="PertemuanDaftarTab-tab" data-bs-toggle="tab"
                            data-bs-target="#PertemuanDaftarTab" type="button" role="tab"
                            aria-controls="PertemuanDaftarTab" aria-selected="false">
                            <i class="fas fa-chalkboard me-2"></i>Pertemuan Kelas
                        </button>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content" id="pembelajaranTabs">
                    <!--Daftar Pembelajaran -->
                    <div class="tab-pane fade show active" id="pembelajaranDaftarTab" role="tabpanel"
                        aria-labelledby="pembelajaranDaftarTab-tab">
                        @include('admin.akademik.tab_content.tab_pane_proses_pembelajaran')
                    </div>
                    <!--End-->

                    <!--Daftar Pertemuan-->
                    <div class="tab-pane fade" id="PertemuanDaftarTab" role="tabpanel"
                        aria-labelledby="PertemuanDaftarTab-tab">
                        @include('admin.akademik.tab_content.tab_pane_pertemuan')
                    </div>
                    <!-- End tab-pane -->

                </div>
                <!--End tab content -->
            </div>
        </div>
    </div>

    <!--script tab tetap ditempat saat reload -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap semua tombol tab
            var triggerTabList = [].slice.call(document.querySelectorAll(
                '#pembelajaranTabs button[data-bs-toggle="tab"]'))
            var tabTrigger;

            // Aktifkan tab terakhir yang disimpan di localStorage
            var activeTabId = localStorage.getItem('activeTabPembelajaran')
            if (activeTabId) {
                tabTrigger = triggerTabList.find(btn => btn.id === activeTabId);
                if (tabTrigger) {
                    var tab = new bootstrap.Tab(tabTrigger)
                    tab.show()
                }
            }

            // Setiap klik tab, simpan id tab ke localStorage
            triggerTabList.forEach(function(btn) {
                btn.addEventListener('shown.bs.tab', function(event) {
                    localStorage.setItem('activeTabPembelajaran', event.target.id)
                })
            })
        })
    </script>

@endsection




{{-- Modal Tambah Pertemuan  Ini besokl --}}
<div class="modal fade" id="tambahPertemuanModal" tabindex="-1" aria-labelledby="tambahPertemuanModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPertemuanModal">Tambah Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="kelasId" class="form-label">Pilih Kelas</label>
                            <select class="form-control" id="kelas_id" name="kelas_id">
                                <option value="" selected disabled>-- Pilih Kelas --</option>

                                <option value="jack"></option>

                            </select>
                        </div>

                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
