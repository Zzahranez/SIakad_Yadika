<!-- Sidebar -->
<nav id="sidebar" class="col-lg-2 d-none d-lg-block overflow-y-auto p-3 text-dark rounded-3 mb-5 sticky-top bg-sidebar"
     style="width: 250px; min-height: 80vh; max-height: 90vh; margin-top: -165px;">
    <!-- Foto Profil -->
    <div class="text-center mt-2">
        <img src="{{ asset('/storage/profile_guru/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
            class="rounded-circle" alt="Foto Profil" width="125" height="125">
    </div>
    <hr class="bg-light w-100 my-3">
 
    <!-- Menu Navigasi -->
    <ul class="nav flex-column w-100">
        <li class="nav-item"><a href="{{ route('gurudash.index') }}"
                class="nav-link text-dark {{ request()->routeIs('gurudash.index') ? 'active' : '' }}"><i
                    class="fas fa-home me-2 "></i><span>Dashboard</span></a></li>

        <li class="nav-item"><a href="{{ route('profileguru.index') }}"
                class="nav-link text-dark {{ request()->routeIs('profileguru.index') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i><span>Profil Guru</span></a></li>

        <li class="nav-item"><a href="{{ route('presensidannilai.index') }}"
                class="nav-link text-dark {{ request()->routeIs('presensidannilai.index') ? 'active' : '' }}"><i
                    class="fas fa-clipboard-user me-2"></i><span>Rekap Kehadiran</span></a></li>

        <li class="nav-item"><a href="{{ route('nilaisiswa.index') }}"
                class="nav-link text-dark {{ request()->routeIs('nilaisiswa.index') ? 'active' : '' }}"><i
                    class="fas fa-user-graduate me-2"></i><span>Lihat Dan Input Niai</span></a></li>

        <li class="nav-item"><a href="{{ route('monitoringpembelajaran.index') }}"
                class="nav-link text-dark {{ request()->routeIs('monitoringpembelajaran.index') ? 'active' : '' }}">
                <i class="fas fa-clipboard-check me-2"></i><span>Tambah Pertemuan</span></a></li>
        <li class="nav-item"><a href="{{ route('JadwalPresensiGuru.index') }}"
                class="nav-link text-dark {{ request()->routeIs('JadwalPresensiGuru.index') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i><span>Pertemuan dan jadwal presensi</span></a></li>

        <li class="nav-item mt-5">
            <form action="{{ route('logoutproses') }}" method="POST" class="d-inline">
                @csrf
                <button
                    class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2 fw-bold rounded-pill py-1 shadow-sm mt-5 border-2"
                    type="submit">
                    <i class="fas fa-power-off"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </li>
    </ul>
</nav>
