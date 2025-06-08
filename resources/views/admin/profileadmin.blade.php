@extends('template_profile')

@section('title', 'Profile | Admin')


@section('image_modal_edit')
    <img src="{{ asset('storage/profile_admin/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
        class="profile-img rounded-circle" alt="Foto Profil">
    <div class="edit-icon" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
        <i class="fas fa-camera"></i>
    </div>
@endsection

@section('data_header')
    <div class="col-md-9">
        <h2 class="fw-bold mb-1">{{ $admin->userable->nama }}</h2>
        <p class="text-white-50"><i class="fas fa-envelope me-2"></i>{{ $admin->email }}</p>
        <p class="text-white-50">
            <i class="fas fa-birthday-cake me-2"></i>{{ \Carbon\Carbon::parse($admin->userable->tanggal_lahir)->age }}
            tahun
        </p>
        <div class="mt-3">
            <span class="badge bg-light text-primary me-2 p-2">
                <i class="fas fa-chalkboard-teacher me-1"></i> {{ Str::title($admin->role) }}
            </span>
            <span class="badge bg-light text-primary p-2">
                <i class="fas fa-user-check me-1"></i> {{ Str::title($admin->userable->status) }}
            </span>
        </div>

        @if (session('debug_info'))
            <div class="alert alert-info">
                <h5>Debug Info:</h5>
                <pre>{{ json_encode(session('debug_info'), JSON_PRETTY_PRINT) }}</pre>
            </div>
        @endif
    </div>
@endsection

{{-- Biodata --}}
@section('biodata')
    @include('admin.profileadmin.form_biodata')
@endsection

{{-- Data akun --}}
@section('data_akun')
    @include('admin.profileadmin.form_data_akun')
@endsection




<!-- Upload Photo Modal -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
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
                <form action="{{route('profileadmin.updateProfileAdmin')}}" method="POST" enctype="multipart/form-data" id="photoForm">
                    @csrf
                    @method('PUT')
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            @yield('image_dalam_modal')
                            <img id="previewImg"
                                src="{{ asset('storage/profile_admin/' . (Auth::user()->userable->foto_profile ?? 'default-profile.jpg')) }}"
                                class="rounded-circle img-thumbnail"
                                style="width: 180px; height: 180px; object-fit: cover;">
                            <div
                                class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                <div
                                    class="bg-dark bg-opacity-50 rounded-circle w-100 h-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-camera fa-2x text-white opacity-75"></i>
                                </div>
                            </div>

                            {{-- End image dalam modal --}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="profil" class="form-label fw-bold"><i class="fas fa-file-image me-2"></i>Pilih
                            Foto</label>
                        <input type="file" class="form-control" name="profil_admin" id="profil" accept="image/*">
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
