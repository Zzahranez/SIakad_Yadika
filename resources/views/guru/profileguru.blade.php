<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Guru</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --accent-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }

        .profile-header {
            background: linear-gradient(to right, var(--primary-color), #224abe);
            padding: 2rem 0;
            border-radius: 15px;
            margin-bottom: 2rem;
            color: white;
        }

        .profile-img-container {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: var(--secondary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .edit-icon:hover {
            background-color: #169e6d;
            transform: scale(1.1);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }

        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-success:hover {
            background-color: #169e6d;
            border-color: #169e6d;
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #be3d30;
            border-color: #be3d30;
        }

        .progress-bar {
            background-color: var(--primary-color);
        }

        .nav-tabs .nav-link {
            color: var(--dark-color);
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            background-color: transparent;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-floating label {
            color: #6c757d;
        }

        .input-group-text {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Toast notification */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1060;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-img-container {
                width: 150px;
                height: 150px;
            }

            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

@include('session.session_pop')


    <div class="container py-5">


        <!-- Profile Header -->
        <div class="profile-header animate__animated animate__fadeIn mb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <div class="profile-img-container mb-3">
                            <img src="{{ asset('storage/profile_guru/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
                                class="profile-img rounded-circle" alt="Foto Profil">
                            <div class="edit-icon" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h2 class="fw-bold mb-1">{{ $guru->userable->nama }}</h2>
                        <p class="text-white-50 mb-2"><i class="fas fa-id-card me-2"></i>NIP: {{ $guru->userable->nip }}
                        </p>
                        <p class="text-white-50"><i class="fas fa-envelope me-2"></i>{{ $guru->email }}</p>
                        <p class="text-white-50">
                            <i
                                class="fas fa-birthday-cake me-2"></i>{{ \Carbon\Carbon::parse($guru->userable->tanggal_lahir)->age }}
                            tahun
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-light text-primary me-2 p-2">
                                <i class="fas fa-chalkboard-teacher me-1"></i> Guru
                            </span>
                            <span class="badge bg-light text-primary p-2">
                                <i class="fas fa-user-check me-1"></i> Aktif
                            </span>
                        </div>

                        @if (session('debug_info'))
                            <div class="alert alert-info">
                                <h5>Debug Info:</h5>
                                <pre>{{ json_encode(session('debug_info'), JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
            <li class="nav-guru" role="presentation">
                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal"
                    type="button" role="tab" aria-controls="personal" aria-selected="true">
                    <i class="fas fa-user me-2"></i>Data Pribadi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button"
                    role="tab" aria-controls="account" aria-selected="false">
                    <i class="fas fa-lock me-2"></i>Akun
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="profileTabsContent">

            {{-- Biodata Guru --}}
            @include('guru.profileguru.form_data')

            <!-- Account Data Tab -->
            @include('guru.profileguru.form_akun')

            {{-- End tab content --}}
        </div>
    </div>




    {{--  --}}
    <!-- Upload Photo Modal -->
    <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="uploadPhotoModalLabel">
                        <i class="fas fa-camera me-2"></i>Perbarui Foto Profil
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profileguru.UpdateProfileGuru') }}" method="POST"
                        enctype="multipart/form-data" id="photoForm">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                {{-- Image --}}
                                <img id="previewImg"
                                    src="{{ asset('storage/profile_guru/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
                                    class="rounded-circle img-thumbnail"
                                    style="width: 180px; height: 180px; object-fit: cover;">
                                <div
                                    class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <div
                                        class="bg-dark bg-opacity-50 rounded-circle w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-camera fa-2x text-white opacity-75"></i>
                                    </div>
                                </div>
                                {{-- End Image --}}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profil" class="form-label fw-bold"><i
                                    class="fas fa-file-image me-2"></i>Pilih
                                Foto</label>
                            <input type="file" class="form-control" name="profil_guru" id="profil"
                                accept="image/*">
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-save-photo" style="background: #3c6399">
                                <i class="fas fa-save me-2 text-white"> </i> <span class=" text-white">Simpan
                                    Foto</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
