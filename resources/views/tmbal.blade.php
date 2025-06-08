<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Siakad')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Untuk Animasi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        .sidebar-collapsed {
            width: 80px !important;
            overflow: hidden;
        }

        .sidebar-collapsed .nav-item span {
            display: none;
        }

        /* Hide the title text when sidebar is collapsed */
        .sidebar-collapsed .d-flex.align-items-center div {
            display: none;
        }

        /* Hide profile photo when sidebar is collapsed */
        .sidebar-collapsed .text-center {
            display: none;
        }

        /* Center and increase logo size when sidebar is collapsed */
        .sidebar-collapsed .d-flex.align-items-center {
            justify-content: center !important;
            margin-top: 20px !important;
        }

        .sidebar-collapsed .d-flex.align-items-center img {
            width: 50px !important;
            height: 50px !important;
            margin-right: 0 !important;
        }

        /* Hide the divider line when sidebar is collapsed */
        .sidebar-collapsed hr {
            display: none;
        }


        #sidebar.sidebar-collapsed~#sidebarToggle {
            margin-left: 100px;
            /* Sesuaikan dengan lebar sidebar yang collapsed */
            transition: margin-left 0.3s ease;
        }

        /* Untuk tombol normal */
        #sidebarToggle {
            transition: margin-left 0.3s ease;
        }

        /* Modal untuk Mobile */
        @media (max-width: 576px) {
            .modal-dialog {
                max-width: 60%;
                /* 90% dari lebar layar */
                margin: 10px auto;
            }
        }

        /* Navlink kids */
        .nav-link.active {
            background-color: #ebeef023;

            color: white;

            font-weight: bold;

            border-radius: 10% box-shadow: 0 2px 8px rgba(255, 255, 255, 0.2);

            transition: all 0.3s ease-in-out;
            transform: scale(1.02);
            /* sedikit membesar */
            border-left: 4px solid #ffffff;
            /* garis samping putih */
        }
    </style>

</head>

<body class="bg-light">
    <div class="container-fluid">

        <div class="row bg-black text-white py-5 rounded-5"
            style="min-height: 350px; background: linear-gradient(135deg, #3c6399 0%, #4f75ad 30%, #aabbd1 50%, #ffffff 60%, #777777 80%, #000000 100%);">
            <div class="col text-center">
                <!-- Header content -->
            </div>
        </div>

        <div class="container">
            <div class="row">

                {{-- Side Bar --}}

                @include('siswa.component.navsiswa')

                <!-- Konten Utama -->
                <div id="content" class="col-lg-9 ms-4" style="margin-top: -20px;">
                    <!-- Navbar Atas -->
                    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm rounded"> --}}
                    <div class="container-fluid">
                        <!-- Button Tutup -->
                        <button id="sidebarToggle" class="btn d-none d-block bg-white shadow">
                            <i class="fas fa-bars"></i>
                        </button>

                        <!-- Tombol Toggle Sidebar (Muncul hanya di mobile) -->
                        <button class="btn d-lg-none bg-white" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#sidebarMobile">
                            <i class="fas fa-bars"></i>
                        </button>

                        {{-- <div class="ms-auto d-flex align-items-center">
                                <div class="dropdown me-3 position-relative">
                                     <button class="btn position-relative" type="button" id="notificationDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bell"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                                    </button> 
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                        <li><a class="dropdown-item" href="#">Nilai UTS telah dipublish</a></li>
                                        <li><a class="dropdown-item" href="#">Deadline tugas Algoritma</a></li>
                                        <li><a class="dropdown-item" href="#">Pembayaran SPP tersisa 3 hari</a></li>
                                    </ul>
                                </div> 
                                <div class="dropdown">
                                    <button class="btn d-flex align-items-center" type="button" id="userDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/api/placeholder/48/48" alt="User Avatar" class="user-avatar me-2">
                                        <span class="d-none d-md-block">Budi Santoso</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="fas fa-cog me-2"></i>Pengaturan</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="#"><i
                                                    class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                    </div>
                    </nav>

                    <!-- Dashboard Content -->
                    <div class="container px-4">

                        <div class="row mb-4 mt-5">
                            <div class="col text-center">
                                <h2 class="fw-bold text-primary">Dashboard akademik</h2>
                                <p class="text-muted fs-5">
                                    🎓 Selamat datang,
                                    <span class="fw-semibold text-dark">{{ $nama_user->userable->nama }}</span>.
                                    <br>
                                    📚 Tahun Akademik {{ $tahun_akademik }} – Semester {{ $semester }}
                                    {{-- <br>
                                    📅 Data per tanggal: {{ $date }} --}}
                                </p>

                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="row g-4">
                            <!-- Stats Cards -->
                            <div class="row g-4">
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="card shadow border-1 rounded-4 p-3 p bg-white ">
                                        <div class="d-flex align-items-center">
                                            <div class="icon bg-primary text-white rounded-circle p-3 me-3">
                                                <i class="fas fa-graduation-cap fa-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-secondary">Nilai Rata-Rata</h6>
                                                <h2 class="fw-bold text-dark">3.85</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="card shadow border-1 rounded-4 p-3 bg-white">
                                        <div class="d-flex align-items-center">
                                            <div class="icon bg-warning text-white rounded-circle p-3 me-3">
                                                <i class="fas fa-book fa-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-secondary">Pertemuan Berlangsung</h6>
                                                <h2 class="fw-bold text-dark">24</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="card shadow border-1 rounded-4 p-3 bg-white">
                                        <div class="d-flex align-items-center">
                                            <div class="icon bg-success text-white rounded-circle p-3 me-3">
                                                <i class="fas fa-calendar-check fa-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-secondary">Kehadiran</h6>
                                                <h2 class="fw-bold text-dark">92%</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Grafik -->
                            <div class="card mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">Grafik Nilai Per Semester</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="nilaiChart" style="max-width: 100%; height: auto !important;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore molestias voluptatibus eius
                        a unde temporibus incidunt eum, ducimus beatae rerum nam cum recusandae quibusdam velit
                        minus, ipsa blanditiis? Sunt, nulla.
                        Odit consequuntur, nemo maxime sed placeat nihil quae accusantium exercitationem, cum
                        aperiam harum, vitae maiores est quidem. Nisi adipisci suscipit similique repudiandae in
                        porro cupiditate laborum recusandae, obcaecati odit necessitatibus?
                        Soluta sit ab quo quas! Ex, incidunt architecto. Beatae nam obcaecati sunt omnis fugit non
                        distinctio facilis. Perferendis excepturi, cum officia dolorem quia, natus, illo id
                        assumenda non ex provident.
                        Sequi excepturi sapiente, velit aperiam quos ea, voluptatibus vero ex, rerum magnam
                        obcaecati voluptates repellat dolore aliquid quaerat voluptate iusto dicta modi? Vero, minus
                        quas! Nemo, sunt. Dicta, beatae corrupti?
                        Id recusandae magnam beatae et voluptatibus ut, inventore omnis rem in quidem dolorum cum
                        harum cumque quae ab expedita accusantium ipsam, unde doloribus dolor facere quasi. Quaerat
                        repellat quis aspernatur.
                        Adipisci quas, quibusdam autem qui sint sunt, dolorem excepturi id repellat placeat corrupti
                        nobis quisquam eligendi necessitatibus dignissimos libero aliquid consequuntur laborum? Iste
                        aperiam, repellat in sint molestiae ipsum pariatur?
                        Tempora, quos, asperiores eaque autem ea beatae aliquid incidunt itaque cumque ut modi nam
                        corrupti est, expedit

                    </div>
                </div>
            </div>


        </div>
        <!-- Aesthetic Small Footer -->
        <footer class="bg-dark text-white py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-auto me-auto">
                        <p class="mb-0 fw-light"><i class="bi bi-c-circle me-1"></i>2025 Your Brand</p>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-twitter-x fs-5"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Sidebar Mobile (Offcanvas) -->
    @include('siswa.component.sidebarmobilesiswa')



    <!-- Script Toggle -->
    <script>
        document.getElementById("sidebarToggle").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("sidebar-collapsed");
        });
    </script>

    <!-- Script Dropdown
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Script Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ambil elemen canvas
        var ctx = document.getElementById('nilaiChart').getContext('2d');

        // Data contoh (ganti dengan nilai siswa yang sesuai)
        var dataNilai = {
            labels: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6'],
            datasets: [{
                label: 'Rata-rata Nilai',
                data: [80, 85, 78, 88, 90, 92], // Gantilah dengan nilai sebenarnya
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna area grafik
                borderColor: 'rgba(54, 162, 235, 1)', // Warna garis
                borderWidth: 2
            }]
        };

        // Konfigurasi chart
        var config = {
            type: 'line', // Bisa diganti dengan 'bar' untuk grafik batang
            data: dataNilai,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Buat chart
        var nilaiChart = new Chart(ctx, config);
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>