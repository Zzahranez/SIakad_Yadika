<div class="tab-pane fade slide-in" id="account" role="tabpanel" aria-labelledby="account-tab">
    <div class="card shadow p-4">
        <div class="card-header bg-transparent border-0 pb-0">
            <h4 class="mb-0 text-primary"><i class="fas fa-user-shield me-2"></i>Data Akun</h4>
        </div>
        <div class="card-body">
            <form action="{{route('profileakademiksiswa.update')}}" method="POST" id="accountForm">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama"
                            value="{{ $user->userable->nama }}">
                        <label for="nama"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                            value="{{ $user->email }}">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Password">
                        <label for="password"><i class="fas fa-key me-2"></i>Password Baru</label>
                    </div>

                </div>
                <div class="mb-4">
                    <div class="form-floating">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Konfirmasi Password">
                        <label for="password_confirmation"><i class="fas fa-key me-2"></i>Konfirmasi
                            Password</label>
                    </div>
                    <div class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button type="submit" class="btn btn-success w-100 btn-save-account">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('profileadmin.index') }}" class="btn btn-danger w-100">
                            <i class="fas fa-arrow-left me-2"></i>Kembali Ke Dashboard
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
