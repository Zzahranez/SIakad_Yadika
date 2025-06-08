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
        /* Modal untuk Mobile */
        @media (max-width: 576px) {
            .modal .modal-dialog {
                width: 90%;
                max-width: none;
                /* Hilangkan max-width default Bootstrap */
            }
        }

        /* |====================| */
        /* |Header untuk mobile=|*/
        /* |====================| */
        /* Mobile Deffault */
        .responsive-header {
            min-height: 250px;
        }

        /* Tablet */
        @media (min-width: 576px) {
            .responsive-header {
                min-height: 250px;
            }
        }

        /* Desktop */
        @media (min-width: 768px) {
            .responsive-header {
                min-height: 320px;
            }
        }

        /* Large Desktop */
        @media (min-width: 992px) {
            .responsive-header {
                min-height: 370px;
            }
        }

        /* ========================= */
        /* Efek untuk nav-link aktif */
        /* ========================= */
        .nav-link.active {
            background-color: #ebeef023;
            color: white;
            font-weight: bold;
            border-radius: 10%;
            padding: 8px 12px;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease-in-out;
            transform: scale(1.02);
            border-left: 4px solid #ffffff;
            border-bottom: none !important;
        }

        /* ================================================= */
        /* Efek 3D push dan liquid fill untuk nav-link biasa */
        /* ================================================= */
        .nav-link {
            transition: all 0.3s ease;
            transform-style: preserve-3d;
            border-radius: 5px;
            position: relative;
            overflow: visible;
            /* Pastikan dropdown tidak tertutup */
            z-index: 1;
            border-bottom: none !important;
        }

        .nav-link:hover {
            transform: translateY(2px) rotateX(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border-bottom: none !important;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: rgba(165, 173, 182, 0.167);
            transition: height 0.35s ease;
            z-index: -1;
        }

        .nav-link:hover:after {
            height: 100%;
        }

        /* Khusus untuk dropdown: nonaktifkan liquid fill, pertahankan efek 3D */
        /* Dipisahkan menjadi dua bagian: dropdown icon dan liquid fill effect */

        /* ======================= */
        /* Ini untuk ikon dropdown */
        /* ======================= */
        .dropdown-toggle::after {
            display: inline-block !important;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }

        /* Nonaktifkan efek liquid fill pada item dropdown */
        .nav-item.dropdown .nav-link:after {
            display: none !important;
            content: none !important;
        }

        .nav-link.dropdown-toggle:hover {
            transform: translateY(2px) rotateX(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-bottom: none !important;
        }

        /* Aturan dropdown */
        .nav-item.dropdown {
            position: relative;
            /* Pastikan posisi relatif untuk dropdown */
        }

        /* Hapus garis bawah pada menu dropdown */
        .nav-item.dropdown:after {
            display: none !important;
            content: none !important;
        }

        /* Hapus garis bawah horizontal pada container dropdown */
        .nav-item.dropdown {
            border-bottom: none !important;
        }

        .nav-item.dropdown .dropdown-menu {
            position: absolute;
            z-index: 1000;
            left: 10px;
            /* Geser ke kanan */
            top: 100%;
            /* Muncul tepat di bawah toggle */
            margin-top: 0.125rem;
            border-radius: 0.25rem;
            padding: 0.5rem 0;
        }

        /* Pastikan dropdown muncul saat class show aktif */
        .dropdown-menu.show {
            display: block !important;
        }

        .nav-link.dropdown-toggle {
            position: relative;
            z-index: 2;
            border-bottom: none !important;
        }

        .nav-link.dropdown-active {
            border-left: 4px solid #ffffff !important;
            padding-left: 8px !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
            font-weight: 600 !important;
        }

        /* Indikator garis bawah untuk dropdown-active */
        .nav-link.dropdown-active:before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #ffffff;
            opacity: 0.7;
        }

        /* Pastikan efek liquid fill tidak mengganggu indikator dropdown-active */
        .nav-link.dropdown-active:after {
            display: none !important;
        }

        /* TAMBAHAN UNTUK ITEM DROPDOWN YANG AKTIF */
        /* Mengubah warna background item dropdown yang aktif */
        .dropdown-menu-dark .dropdown-item.active,
        .dropdown-menu-dark .dropdown-item:active {
            background-color: rgba(255, 255, 255, 0.15) !important;
            /* Putih dengan opasitas rendah */
            color: #ffffff !important;
            /* Text tetap putih */
            font-weight: 600 !important;
            /* Sedikit lebih tebal untuk emphasis */
        }

        /* Tambahkan efek hover yang sesuai */
        .dropdown-menu-dark .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Menambahkan indikator kecil di sebelah kiri item aktif */
        .dropdown-menu-dark .dropdown-item.active:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 3px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 0 2px 2px 0;
        }

        /* Pastikan posisi relatif untuk positioning yang benar */
        .dropdown-menu-dark .dropdown-item {
            position: relative;
            transition: all 0.2s ease;
        }

        /* ========================= */
        /* ====Wajib untuk hover==== */
        /* ========================= */

        .hover-transition {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        /* ========================= */
        /* ========= HOOVER ======== */
        /* ========================= */
        .hover-multi {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hover-multi:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            filter: brightness(1.02);
        }

        .hover-multi:active {
            transform: translateY(-2px);
            transition: all 0.1s ease;
        }

        .hover-smooth {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hover-smooth:hover {
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        .hover-glow {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
            transform: scale(1.02);
        }

        /* ================================== */
        /* ========BACKGROUND DAN TEXT======= */
        /* ================================== */

        .bg-birumantap{
            background-color: #2d65b2 ! important;
        }
        .text-birumantap{
            color: #2d65b2 !important;
        }

    </style>

</head>

<body class="bg-light">
    {{-- Library chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container-fluid">
        <!-- Dengan Warna -->
        {{-- <div class="row bg-black text-white py-5 rounded-5 "
            style="min-height: 350px; background: linear-gradient(135deg, #3c6399 0%, #4f75ad 30%, #aabbd1 50%, #ffffff 60%, #777777 80%, #000000 100%);">
            <div class="col text-center">
                <!-- Header content -->
            </div>
        </div> --}}

        <!-- Opsi 2 Recomend kalau cuma mau nampilin-->
        <div class="row text-white py-5 rounded-2 responsive-header"
            style=" 
            background-image: url('{{ asset('SMA_image.jpeg') }}');
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;">
            <div class="col text-center">
                <!-- Tambahkan overlay untuk readability -->

                <!-- Header content Anda di sini -->
            </div>
        </div>
    </div>

    <!--Untuk Text mudah dibaca-->
    {{-- <div class="row text-white py-5 rounded-5 mb-4"
            style="min-height: 350px; 
                    background-image: url('{{ asset('SMA_image.jpeg') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;">
            <div class="col text-center d-flex align-items-center justify-content-center">
                <div>
                    <h1 style="text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9); font-weight: bold;">Header Tanpa Overlay
                    </h1>
                    <p style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9); font-weight: 500;">Gunakan text-shadow yang
                        kuat</p>
                </div>
            </div>
        </div> --}}

    <div class="container">
        <div class="row">

            {{-- Side Bar --}}
            @yield('sidebar')

            <!-- Konten Utama -->
            <div id="content" class="col-lg-9 ms-4" style="margin-top: -20px;">
                <!-- Navbar Atas -->

                <div class="container-fluid">
                    <!-- Button Tutup -->
                    {{-- <button id="sidebarToggle" class="btn d-none d-block bg-white shadow">
                            <i class="fas fa-bars"></i>
                        </button> --}}

                    <!-- Tombol Toggle Sidebar (Muncul hanya di mobile) -->
                    <button class="btn d-lg-none bg-white" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebarMobile">
                        <i class="fas fa-bars"></i>
                    </button>


                </div>


                <!-- Dashboard Content -->
                <div class="container px-4">

                    @yield('titledash')

                    <!-- Stats Cards -->
                    <div class="row g-4">
                        <!-- Stats Cards -->

                        @yield('statscard')


                        <!-- Grafik -->
                        {{-- <div class="card mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">Grafik Nilai Per Semester</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="nilaiChart" style="max-width: 100%; height: auto !important;"></canvas>
                                </div>
                            </div> --}}

                        @yield('Table')

                    </div>
                </div>

                @yield('konten tambahan')

            </div>
        </div>

    </div>


    <footer class=" text-white py-4 mt-5" style="font-family: Inter, sans-serif; background-color: #404040">
        <div class="w-100 px-3">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class=" col-md-2">
                        <p class="mb-0 fw-light">
                            <i class="bi bi-c-circle me-1"></i>YAYASAN ABDIKARYA
                        </p>
                    </div>
                    {{-- <div class="col-auto">
                        <p class="mb-0 fw-light">
                            Kontak
                        </p>
                        <i class="fas fa-envelope text-white me-1 mt-3"></i>
                        <div class=" text-sm d-inline-block mt-2">
                            siakadyadika@gmail.com
                        </div>
                        <br>
                        <i class="fas fa-globe text-white me-1 mt-2"></i>
                        <a href="https://siakadYadika.ac.id/"
                            class="text-white text-decoration-none text-sm d-inline-block">https://siakadYadika.ac.id/</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </footer>

    <!-- Sidebar Mobile (Offcanvas) -->
    {{-- @include('siswa.component.sidebarmobilesiswa') --}}
    @include('sidebarmobile')

    <!-- Script Grafik -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
