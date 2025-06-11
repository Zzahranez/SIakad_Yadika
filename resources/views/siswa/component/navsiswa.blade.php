 <!-- Sidebar -->
 <nav id="sidebar" class="col-lg-2 d-none d-lg-block overflow-y-auto p-3 text-dark rounded-3 mb-5 sticky-top bg-sidebar"
     style="width: 250px; min-height: 80vh; max-height: 90vh; margin-top: -165px;">
     <!-- Logo & Judul -->
     {{-- <div class="d-flex align-items-center mt-2">
     <img src="SMA_yayasandika-removebg-preview.png" alt="Logo" width="40" height="40" class="me-2">
     <div class="mb3" style="font-size: 22px; font-family:'Times New Roman', Times, serif;">
         Siakad Yadika
     </div>
 </div> --}}
     <!-- Foto Profil -->
     <div class="text-center mt-2">
         <img src="{{ asset('storage/profile_siswa/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
             class="rounded-circle" alt="Foto Profil" width="125" height="125">
     </div>
     <hr class="bg-light w-100 my-3">

     <!-- Menu Navigasi -->
     <ul class="nav flex-column w-100">
         <li class="nav-item "><a href="{{ route('dashboardsiswa.index') }}"
                 class="nav-link text-dark {{ request()->routeIs('dashboardsiswa.index') ? 'active' : '' }}"><i
                     class="fas fa-home me-2"></i><span>Dashboard</span></a></li>


         <li class="nav-item"><a href="{{ route('nilaiSiswaVisualisasi.index') }}"
                 class="nav-link text-dark {{ request()->routeIs('nilaiSiswaVisualisasi.index') ? 'active' : '' }}"><i
                     class="fas fa-file-contract me-2"></i><span>Nilai</span></a></li>


         <li class="nav-item"><a href="{{ route('presensisiswa.index') }}"
                 class="nav-link text-dark {{ request()->routeIs('presensisiswa.index') ? 'active' : '' }}"><i
                     class="fas fa-clipboard me-2"></i><span>Presensi</span></a></li>

         <li class="nav-item"><a href="{{ route('profileakademiksiswa.index') }}" class="nav-link text-dark"><i
                     class="fas fa-user-graduate me-2"></i><span>Profil Akademik</span></a></li>
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
