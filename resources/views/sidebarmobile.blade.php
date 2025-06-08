@php
    $role = Auth::user()->role;
@endphp

<div class="offcanvas offcanvas-start " tabindex="-1" id="sidebarMobile" style="width: 270px;">
    <div class="offcanvas-header text-dark p-2 border-bottom shadow-sm" style="background-color: #3c6399 80%">
        <h5 class="offcanvas-title mb-0">Admin</h5>
        <button type="button" class="btn-close btn-close-dark text-reset me-1 my-1 border border-dark"
            data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body bg-opacity-25"
        style="background-color: #3c6399; display: flex; flex-direction: column; height: 100%;">

        @if ($role === 'admin')
            <div class="text-center mt-2">
                <img src="{{ asset('storage/profile_admin/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
                    class="rounded-circle" alt="Foto Profil" width="110" height="110">
            </div>
        @elseif ($role === 'guru')
            <div class="text-center mt-2">
                <img src="{{ asset('storage/profile_guru/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
                    class="rounded-circle" alt="Foto Profil" width="110" height="110">
            </div>
        @elseif ($role === 'siswa')
            <div class="text-center mt-2">
                <img src="{{ asset('storage/profile_siswa/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
                    class="rounded-circle" alt="Foto Profil" width="110" height="110">
            </div>
        @endif
        <!-- Garis Horizontal -->
        <hr class="bg-light w-100 my-3">
        <ul class="nav flex-column">
            <!-- Admin -->
            @if ($role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('admindash.index') }}"
                        class="nav-link text-white {{ request()->routeIs('admindash.index') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profileadmin.index') }}"
                        class="nav-link text-white {{ request()->routeIs('profileadmin.index') ? 'active' : '' }}">
                        <i class="fas fa-id-card me-2"></i><span>Profile Dan Biodata</span>
                    </a>
                </li>

                <!-- Dropdown akademik -->
                <li class="nav-item dropdown">
                    <a href="#"
                        class="nav-link text-white d-flex align-items-center dropdown-toggle {{ request()->routeIs('managemapel.index') || request()->routeIs('managepembelajaran.index') ? 'dropdown-active' : '' }}"
                        id="akademikDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <i class="fas fa-university me-2"></i><span>Akademik</span>
                        <i class="fas fa-caret-down ms-2 ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-white ms-0" aria-labelledby="akademikDropdown"
                        style="position: relative; width: 100%; transform: none !important;">
                        <li>
                            <a href="{{ route('managemapel.index') }}"
                                class="dropdown-item {{ request()->routeIs('managemapel.index') ? 'active' : '' }}">
                                <i class="fas fa-book-open me-2"></i> Mata Pelajaran
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('managepembelajaran.index') }}"
                                class="dropdown-item {{ request()->routeIs('managepembelajaran.index') ? 'active' : '' }}">
                                <i class="fas fa-book-reader me-2"></i> Proses Pembelajaran
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Kelas -->
                <li class="nav-item dropdown">
                    <a href="#"
                        class="nav-link text-white d-flex align-items-center dropdown-toggle {{ request()->routeIs('managekelas.index') || request()->routeIs('kelulusansiswashow') ? 'dropdown-active' : '' }}"
                        id="kelasDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <i class="fas fa-chalkboard me-2"></i>
                        <span>Kelas & Kelulusan</span>
                        <i class="fas fa-caret-down ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-white ms-0" aria-labelledby="kelasDropdown"
                        style="position: relative; width: 100%; transform: none !important;">
                        <li>
                            <a href="{{ route('managekelas.index') }}"
                                class="dropdown-item {{ request()->routeIs('managekelas.index') ? 'active' : '' }}">
                                <i class="fas fa-list me-2"></i> Kelola Kelas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kelulusansiswashow') }}"
                                class="dropdown-item {{ request()->routeIs('kelulusansiswashow') ? 'active' : '' }}">
                                <i class="fas fa-user-check me-2"></i> Luluskan Siswa
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manageuser.index') }}"
                        class="nav-link text-white {{ request()->routeIs('manageuser.index') ? 'active' : '' }}">
                        <i class="fas fa-user-friends me-2"></i><span>Kelola Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-clipboard me-2"></i><span>Kelola Nilai</span>
                    </a>
                </li>
                <!-- Admin End nav-->
                <!-- Siswa Nav-->
            @elseif ($role === 'siswa')
                <li class="nav-item "><a href="{{ route('dashboardsiswa.index') }}"
                        class="nav-link text-white {{ request()->routeIs('dashboardsiswa.index') ? 'active' : '' }}"><i
                            class="fas fa-home me-2"></i><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white"><i
                            class="fas fa-file-contract me-2"></i><span>Nilai</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white"><i
                            class="fas fa-clipboard me-2"></i><span>Presensi</span></a></li>

                <li class="nav-item"><a href="{{ route('profileakademiksiswa.index') }}" class="nav-link text-white"><i
                            class="fas fa-user-graduate me-2"></i><span>Profil Akademik</span></a></li>
                <!-- Siswa End nav-->
                <!-- Guru End nav-->
            @elseif ($role === 'guru')
                <li class="nav-item"><a href="{{ route('gurudash.index') }}"
                        class="nav-link text-white {{ request()->routeIs('gurudash.index') ? 'active' : '' }}"><i
                            class="fas fa-home me-2 "></i><span>Dashboard</span></a></li>

                <li class="nav-item"><a href="{{ route('profileguru.index') }}"
                        class="nav-link text-white {{ request()->routeIs('profileguru.index') ? 'active' : '' }}"><i
                            class="fas fa-user-graduate me-2 "></i><span>Profil
                            Guru</span></a></li>

                <li class="nav-item"><a href="#" class="nav-link text-white"><i
                            class="fas fa-user-graduate me-2"></i><span>Nilai Siswa</span></a></li>

                <li class="nav-item"><a href="#" class="nav-link text-white"><i
                            class="fas fa-clipboard me-2"></i><span>Manage Pertemuan</span></a></li>
                <!-- Guru End nav-->
            @endif
            <li class="nav-item mt-4">

                <form action="{{ route('logoutproses') }}" method="POST" class="d-inline">
                    @csrf
                    <button
                        class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2 fw-bold rounded-pill py-1 shadow-sm border-2"
                        type="submit">
                        <i class="fas fa-power-off"></i>
                        <span>Keluar</span>
                    </button>
                </form>

            </li>
        </ul>
        <!--End Nav -->
    </div>
</div>
