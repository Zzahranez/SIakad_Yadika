 <!-- Sidebar -->
 <nav id="sidebar" {{-- class="col-lg-2 d-none d-lg-block overflow-y-auto p-3 text-white bg-dark rounded-3 mb-5 sticky-top shadow-lg"
     style="width: 250px;min-height: 80vh;max-height:90vh; margin-top: -210px; background: linear-gradient(135deg, #212121, #404040, #3c4147 70%, #ffffff 90%, #4f75ad 80%, #3c6399);"> --}}
     class="col-lg-2 d-none d-lg-block overflow-y-auto p-3 text-white rounded-3 mb-5 sticky-top shadow-lg"
     style="width: 250px; min-height: 80vh; max-height: 90vh; margin-top: -210px; background-color: #3c6399">


     <!-- Foto Profil -->
     <div class="text-center mt-2">
         <img src="{{ asset('storage/profile_admin/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
             class="rounded-circle" alt="Foto Profil" width="125" height="125">
     </div>
     <hr class="bg-light w-100 my-3">
     <!-- Menu Navigasi -->
     <ul class="nav flex-column w-100">
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

         {{-- DropDown akademik --}}
         <li class="nav-item dropdown">
             <a href="#"
                 class="nav-link text-white d-flex align-items-center dropdown-toggle {{ request()->routeIs('managemapel.index') || request()->routeIs('managepembelajaran.index') ? 'dropdown-active' : '' }}"
                 id="kelasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="fas fa-university me-2"></i><span>Akademik</span>
                 <i class="fas fa-caret-down ms-auto"></i>
             </a>
             <ul class="dropdown-menu dropdown-menu-light w-100" aria-labelledby="kelasDropdown">
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
                 <li>
                     <a href="{{ route('managepresensi.index') }}"
                         class="dropdown-item {{ request()->routeIs('managepresensi.index') ? 'active' : '' }}">
                         <i class="fas fa-hand-pointer me-2"></i> Kelola Presensi
                     </a>
                 </li>
             </ul>
         </li>
         {{-- DropDown Kelas --}}
         <li class="nav-item dropdown">
             <a href="#"
                 class="nav-link text-white d-flex align-items-center dropdown-toggle {{ request()->routeIs('managekelas.index') || request()->routeIs('kelulusansiswashow') ? 'dropdown-active' : '' }}"
                 id="kelasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="fas fa-chalkboard me-2"></i><span>Kelas & Kelulusan</span>
                 <i class="fas fa-caret-down ms-auto"></i>
             </a>
             <ul class="dropdown-menu dropdown-menu-light w-100" aria-labelledby="kelasDropdown">
                 <li>
                     <a href="{{ route('managekelas.index') }}"
                         class="dropdown-item {{ request()->routeIs('managekelas.index') ? 'active' : '' }}">
                         <i class="fas fa-list me-2"></i> Kelola Kelas
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('kelulusansiswashow') }}"
                         class="dropdown-item {{ request()->routeIs('kelulusansiswashow') ? 'active' : '' }}">
                         <i class="fas fa-user-check"></i> Luluskan Siswa
                     </a>
                 </li>
             </ul>
         </li>


         <li class="nav-item"><a href="{{ route('manageuser.index') }}"
                 class="nav-link text-white {{ request()->routeIs('manageuser.index') ? 'active' : '' }}"><i
                     class="fas fa-user-friends me-2"></i><span>Kelola Users</span></a></li>

         <li class="nav-item"><a href="{{ route('managenilai.index') }}"
                 class="nav-link text-white {{ request()->routeIs('managenilai.index') ? 'active' : '' }}"><i
                     class="fas fa-clipboard me-2"></i><span>Kelola Nilai</span></a></li>
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
