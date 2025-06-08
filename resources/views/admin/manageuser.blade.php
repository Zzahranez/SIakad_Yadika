@extends('template')

@section('title', 'Manage Users')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mb-4 mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-primary">Manage Users</h2>
            <p class="text-muted fs-5">Kelola <span class="fw-semibold text-dark">Data dan Informasi</span> Pengguna</p>
        </div>
    </div>
    <!--Session --> 
    @include('session.session_pop')

@endsection

@section('Table')
    <div class="container py-4">
        {{-- Search Berdasarkan Nama Atau Email --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="GET" action="{{ route('manageuser.index') }}" class="d-flex align-items-center mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-start"
                            placeholder="Cari nama atau email..." value="{{ request('search') }}" aria-label="Search">
                        <button type="submit" class="btn btn-primary  rounded-end hover-glow">
                            <i class="fas fa-search me-1 hover-smooth"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- End search --}}
        <div class="card shadow shadow-lg ">
            <div class="card-header bg-primary bg-gradient d-flex justify-content-between align-items-center p-3 ">
                <h4 class="text-white mb-0 fw-semibold">
                    <i class="fas fa-users me-2"></i>Daftar Users
                </h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="button" class="btn btn-light d-flex align-items-center gap-2 hover-glow" data-bs-toggle="modal"
                    data-bs-target="#tambahUserModal">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah User</span>
                </button>

 
            </div>

            {{-- Table --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="px-4 py-3">Id</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Role</th>
                                <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    {{-- id --}}
                                    <th scope="row" class="px-4">{{ $item->id }}</th>
                                    {{-- Nama --}}
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="avatar avatar-sm bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center">
                                                <span class="text-primary fw-bold">
                                                    {{ strtoupper(substr($item->userable->nama ?? '', 0, 1)) }}</span>
                                            </div>
                                            {{ $item->userable->nama }}
                                        </div>
                                    </td>
                                    {{-- Email --}}
                                    <td class="px-4">{{ $item->email }}</td>
                                    {{-- Role --}}
                                    <td class="px-4">
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">{{ $item->role }}</span>
                                    </td>
                                    {{-- Button Aksi --}}
                                    <td class="text-center">
                                        <div class="btn-group">
                                            {{-- <a href="{{ route('manageuser.show', $item->id) }}"
                                                class="btn btn-sm btn-outline-warning">
                                                <i class="fast fa-list-alt"></i>
                                            </a> --}}

                                            {{-- Button menerima id dari modal yaitu id sehingga hasil dari
                                         setiap klikan pada tabel akan berbeda beda sesuai dengan id users --}}
                                            <button type="button" class="btn btn-sm btn-outline-info hover-smooth"
                                                data-bs-toggle="modal" data-bs-target="#detailUserModal-{{ $item->id }}"
                                                data-id={{ $item->id }}>
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            @include('admin.manageuser.modal_detail')
                                            <button type="button" class="btn btn-sm btn-outline-danger hover-smooth">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal detail --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @include('pagination_footer_card', ['collection' => $users])

        </div>
    </div>



@endsection

@include('admin.manageuser.modal_tambah_users')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const roleForms = document.querySelectorAll('.role-form');

        roleSelect.addEventListener('change', function() {
            // Nonaktifkan dan sembunyikan semua form
            roleForms.forEach(form => {
                form.style.display = 'none';
                form.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = true; // Nonaktifkan input
                });
            });

            // Aktifkan dan tampilkan form yang dipilih
            const selectedRole = this.value;
            if (selectedRole) {
                const activeForm = document.getElementById(selectedRole + 'Form');
                activeForm.style.display = 'block';
                activeForm.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = false; // Aktifkan input
                });
            }

            // Set required fields
            setRequiredFields(selectedRole);
        });

        function setRequiredFields(role) {
            document.querySelectorAll('.role-form input, .role-form select, .role-form textarea').forEach(
                input => {
                    input.removeAttribute('required');
                });

            if (role) {
                document.querySelectorAll(`#${role}Form input, #${role}Form select, #${role}Form textarea`)
                    .forEach(input => {
                        input.setAttribute('required', 'required');
                    });
            }
        }

        // Reset form saat modal ditutup
        const addUserModal = document.getElementById('tambahUserModal');
        addUserModal.addEventListener('hidden.bs.modal', function() {
            document.getElementById('addUserForm').reset();
            roleForms.forEach(form => {
                form.style.display = 'none';
                form.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = true;
                });
            });
        });
    });
</script>
