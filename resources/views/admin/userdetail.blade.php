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

            border-radius: 10% padding: 8px 12px;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.2);
            /* efek glow */
            transition: all 0.3s ease-in-out;
            transform: scale(1.02);
            /* sedikit membesar */
            border-left: 4px solid #ffffff;
            /* garis samping putih */
        }
    </style>

</head>

<body class="bg-light">

    <div class="container">

        <div class=" row">

            <div class=" col-6 offset-2">
                <h2>Detail User</h2>
                <p><strong>Nama:</strong> {{ $user->userable->nama }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
            </div>

            <div class=" col-4">
                <h3>Detail {{ class_basename($user->userable_type) }}</h3>

                @if ($user->userable_type === App\Models\Siswa::class)
                    <p><strong>NIS:</strong> {{ $user->userable->nis }}</p>
                    <p><strong>Kelas:</strong> {{ $user->userable->kelas }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $user->userable->tanggal_lahir }}</p>
                @elseif ($user->userable_type === App\Models\Guru::class)
                    <p><strong>NIP:</strong> {{ $user->userable->nip }}</p>
                    <p><strong>Mata Pelajaran:</strong> {{ $user->userable->mapel }}</p>
                    <p><strong>Alamat</strong></p>
                @elseif ($user->userable_type === App\Models\Admin::class)
                    <p><strong>Posisi:</strong> {{ $user->userable->posisi }}</p>
                @endif
            </div>

        </div>

        <div class="row">
            <div class="card-body">
                {{-- Student Details --}}
                @if ($user->userable_type === App\Models\Siswa::class)
                    <div class="mb-3">
                        <label class="form-label">Student ID (NIS)</label>
                        <input type="text" name="nis_nisn" class="form-control"
                            value="{{ $user->userable->nis_nisn }}" placeholder="Enter student ID">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" name="kelas" class="form-control" value="{{ $user->userable->kelas }}"
                            placeholder="Enter class">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{ $user->userable->tanggal_lahir }}">
                    </div>
                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="laki-laki"
                                {{ $user->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="perempuan"
                                {{ $user->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>
                    {{-- can null data --}}
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $user->userable->alamat }}"
                            placeholder="Enter student ID">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No telepon</label>
                        <input type="text" name="no_telp" class="form-control"
                            value="{{ $user->userable->no_telp }}" placeholder="No telepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Masuk</label>
                        <input type="year" name="tahun_masuk" class="form-control"
                            value="{{ $user->userable->tahun_masuk }}" placeholder="Tahun Masuk">
                    </div>


                    {{-- Teacher Details --}}
                @elseif ($user->userable_type === App\Models\Guru::class)
                    <div class="mb-3">
                        <label class="form-label">Teacher ID (NIP)</label>
                        <input type="text" name="nip" class="form-control" value="{{ $user->userable->nip }}"
                            placeholder="Enter teacher ID">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat_guru" class="form-control"
                            value="{{ $user->userable->alamat }}" placeholder="Enter teacher ID">
                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="laki-laki"
                                    {{ $user->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="perempuan"
                                    {{ $user->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        {{-- no_telp --}}
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" class="form-control"
                            value="{{ $user->userable->no_telp }}" placeholder="Enter teacher ID">
                        {{-- Tanggal lahir --}}
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir_guru" class="form-control"
                            value="{{ $user->userable->tanggal_lahir }}" placeholder="Enter teacher ID">
                    </div>
                    <!-- Status Kepegawaian -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Kepegawaian</label>
                        <select name="status_kepegawaian" class="form-select">
                            <option value="tetap"
                                {{ $user->userable->status_kepegawaian == 'tetap' ? 'selected' : '' }}>
                                Tetap
                            </option>
                            <option value="kontrak"
                                {{ $user->userable->status_kepegawaian == 'kontrak' ? 'selected' : '' }}>
                                Kontrak
                            </option>
                            <option value="honorer"
                                {{ $user->userable->status_kepegawaian == 'honorer' ? 'selected' : '' }}>
                                Honorer
                            </option>
                        </select>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pendidikan Terakhir</label>
                        <select name="pendidikan_terakhir" class="form-select">
                            <option value="S1"
                                {{ $user->userable->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>
                                S1
                            </option>
                            <option value="S2"
                                {{ $user->userable->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>
                                S2
                            </option>
                            <option value="S3"
                                {{ $user->userable->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>
                                S3
                            </option>
                        </select>
                    </div>

                    {{-- Jurusan --}}
                    <label class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control"
                        value="{{ $user->userable->jurusan }}" placeholder="Enter teacher ID">

                    {{-- Tahun masuk --}}
                    <label class="form-label">Tahun masuk</label>
                    <input type="year" name="tahun_masuk" class="form-control"
                        value="{{ $user->userable->tahun_masuk }}" placeholder="Enter teacher ID">

                    {{-- Admin Details --}}
                @elseif ($user->userable_type === App\Models\Admin::class)
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Enter address">{{ $user->userable->alamat }}</textarea>
                    </div>
                    {{-- Jenis Kealmin --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="laki-laki"
                                {{ $user->userable->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="perempuan"
                                {{ $user->userable->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>
                @endif
            </div>
        </div>



        <hr>



    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
