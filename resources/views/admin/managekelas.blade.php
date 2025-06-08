@extends('template')

@section('title', 'Manage Users')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Kelola Kelas</h2>
            <p class="text-muted fs-5">Kelola <span class="fw-semibold text-dark">Data dan Informasi</span> Pengguna</p>
        </div>
    </div>
@endsection


@section('Table')

    {{-- Seesion --}}
    @include('session.session_pop')

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-1" id="profileTabs" role="tablist">
        <li class="nav-guru" role="presentation">
            <button class="nav-link active text-dark" id="managekelas-tab" data-bs-toggle="tab"
                data-bs-target="#managekelas" type="button" role="tab" aria-controls="managekelas"
                aria-selected="true">
                <i class="fas fa-chalkboard-teacher me-2"></i>Kelola Kelas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark" id="perbaruikelas-tab" data-bs-toggle="tab" data-bs-target="#perbaruikelas"
                type="button" role="tab" aria-controls="perbaruikelas" aria-selected="false">
                <i class="fas fa-edit me-2"></i>Naik Kelas
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="profileTabsContent">

        <!-- Tab Pane: Manage Classes -->
        @include('admin.manage_kelas.tab_content.tabpane_manage_kelas')
        {{-- End Tab Pane Manage Kelas --}}

        <!-- Tab Pane: Perbarui Kelas -->
        @include('admin.manage_kelas.tab_content.tabpane_perbarui_kelas')
    </div>

@endsection
