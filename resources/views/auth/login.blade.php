<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siakad Yadika - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Untuk Animasi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body class=" min-vh-100 d-flex align-items-center" style="background-color: #3c6399">
    <div class="container py-5">
        <div class="row justify-content-center g-4">
            <!-- Brand Section -->
            <div class="col-lg-5">
                <div class="text-white p-4 rounded-4 animate__animated animate__fadeInLeft">
                    <div class="text-center text-lg-start">
                        <h1 class="display-5 fw-bold mb-4 text-uppercase ">
                            <i class="fas fa-graduation-cap me-2"></i>Siakad Yadika
                        </h1>
                        <p class="fs-4 mb-4 opacity-75">Sistem Informasi Akademik Yayasan Abdi Karya</p>
                    </div>

                    <div class="d-lg-block d-none">
                        <div class="bg-light bg-opacity-10 p-4 rounded-4 mt-5 shadow-lg">
                            <h5 class="mb-4 border-bottom pb-2">
                                <i class="fas fa-star text-warning me-2"></i>Fitur Unggulan
                            </h5>
                            <div class="mb-3 d-flex align-items-center animate__animated animate__fadeInUp">
                                <div class="bg-warning rounded-circle p-2 me-3">
                                    <i class="fas fa-user-graduate text-primary"></i>
                                </div>
                                <span>Akses Data Akademik Terpadu</span>
                            </div>
                            <div
                                class="mb-3 d-flex align-items-center animate__animated animate__fadeInUp animate__delay-1s">
                                <div class="bg-warning rounded-circle p-2 me-3">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <span>Jadwal Pembelajaran Real-time</span>
                            </div>
                            <div
                                class="mb-3 d-flex align-items-center animate__animated animate__fadeInUp animate__delay-2s">
                                <div class="bg-warning rounded-circle p-2 me-3">
                                    <i class="fas fa-chart-line text-primary"></i>
                                </div>
                                <span>Monitoring Nilai & Presensi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Card -->
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="card border-0 shadow-lg animate__animated animate__fadeInRight">
                    <div class="card-header bg-white text-center border-0 pt-4">
                        <img src="/Logo.png" alt="Logo" class="img-fluid rounded-circle mb-3  shadow-sm ">
                        <h3 class="fw-bold " style="color:#0d47a1">Selamat Datang</h3>
                        <p class="text-muted">Silakan login untuk melanjutkan</p>
                        @if (session('info'))
                            <div class="d-block mt-2">
                                <span class="auto-hide-error badge bg-danger text-white py-2 px-3 rounded-pill">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ session('info') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="card-body p-4">


                        <!-- Login Form -->
                        <form method="POST" action="{{ route('loginproses') }}"
                            class="animate__animated animate__fadeIn animate__delay-1s">
                            @csrf <!-- Laravel CSRF token -->

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control border-0 bg-light" id="emailInput"
                                    name="email" placeholder="Email" required>
                                <label for="emailInput">
                                    <i class="fas fa-envelope text-primary me-2"></i>Email
                                </label>
                                {{-- validasih email --}}
                                @error('email')
                                    <div class="d-block mt-2">
                                        <span class="auto-hide-error badge bg-danger text-white py-2 px-3 rounded-pill">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>


                            <div class="form-floating mb-4">
                                <input type="password" class="form-control border-0 bg-light" id="passwordInput"
                                    name="password" placeholder="Password" required>
                                <label for="passwordInput">
                                    <i class="fas fa-lock text-primary me-2"></i>Password
                                </label>
                                {{-- Validasi password --}}
                                @error('password')
                                    <div class="d-block mt-2">
                                        <span class="auto-hide-error badge bg-danger text-white py-2 px-3 rounded-pill">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </span>
                                    </div>
                                @enderror
                            </div>

                            {{-- cek_box dan lupa password --}}

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">
                                            Ingat Saya
                                        </label>
                                    </div>
                                </div>
                                {{-- <div class="col-6 text-end">
                                    <a href="#" class="text-decoration-none">Lupa Password?</a>
                                </div> --}}
                            </div>

                            <button type="submit"
                                class="btn btn-primary w-100 py-3 mb-3 animate__animated animate__pulse animate__repeat-1">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span class="fw-bold">LOGIN</span>
                            </button>
                        </form>

                        <div class="d-flex align-items-center my-4">
                            <hr class="flex-grow-1 bg-secondary opacity-25">
                            <div class="px-3 text-muted small"></div>
                            <hr class="flex-grow-1 bg-secondary opacity-25">
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{-- <a href="#" class="btn btn-light btn-sm mx-1 rounded-circle shadow-sm">
                                <i class="fab fa-facebook-f text-primary"></i>
                            </a> --}}
                            {{-- <a href="#" class="btn btn-light btn-sm mx-1 rounded-circle shadow-sm">
                                <i class="fab fa-google text-danger"></i>
                            </a> --}}
                            {{-- <a href="#" class="btn btn-light btn-sm mx-1 rounded-circle shadow-sm">
                                <i class="fab fa-twitter text-info"></i>
                            </a> --}}
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 text-center pb-4">
                        <p class="text-muted mb-0 small">
                            <i class="fas fa-shield-alt me-1"></i>
                            2025 Siakad Yadika - Versi 1.0
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    {{-- Time view validasiihhh --}}
    <script>
        // Auto-hide all error messages after 2 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const errors = document.querySelectorAll('.auto-hide-error');
            errors.forEach(function(error) {
                setTimeout(function() {
                    error.classList.remove('show');
                    setTimeout(function() {
                        error.style.display = 'none';
                    }, 150); // Fade out animation time
                }, 5000);
            });
        });
    </script>
</body>

</html>
