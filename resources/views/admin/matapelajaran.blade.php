@extends('template')

@section('title', 'Admin | Mata Pelajaran')

@section('sidebar')
    <!-- Sidebar -->
    @include('admin.component.sidebaradmin')
@endsection

@section('titledash')
    <div class="row mt-5">
        <div class="col text-center">
            <h2 class="fw-bold text-dark">Kelola Mata Pelajaran</h2>
            <p class="text-muted fs-5">Kelola <span class="fw-semibold text-dark">Data dan Informasi</span> Mata Pelajaran</p>
        </div>
    </div>
    @include('session.session_pop')
@endsection

@section('Table')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-lg  border-0 rounded-3">
                    <!-- Card Header -->
                    <div
                        class="card-header bg-birumantap bg-opacity-10 border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                        <h4 class="text-white fw-bold mb-0 d-flex align-items-center">
                            <i class="fas fa-book me-2"></i> Daftar Mata Pelajaran
                        </h4>
                        <button type="button" class="btn btn-light d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#tambahMapelModal">
                            <i class="fas fa-plus-circle"></i>
                            <span>Tambah</span>
                        </button>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 rounded-start">No</th>
                                        <th scope="col" class="px-4 py-3">Mata Pelajaran</th>
                                        <th scope="col" class="px-4 py-3 text-center rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mapels as $mapel_item)
                                        <tr class="bg-white shadow-sm">
                                            <th scope="row" class="px-4">{{ $loop->iteration }}</th>
                                            <td class="px-4">{{ $mapel_item->nama_mapel }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Tombol aksi">
                                                    <button type="button" class="btn btn-sm btn-outline-info px-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editMapelModal-{{ $mapel_item->id }}"
                                                        title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger px-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusMapelModal-{{ $mapel_item->id }}"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('admin.managemapel.modal_edit_mapel')
                                        @include('admin.managemapel.modal_destroy_mapel')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    @include('pagination_footer_card', ['collection' => $mapels])
                    <!-- End Card Footer -->
                </div>
                {{-- End Card --}}
            </div>
        </div>
    </div>
@endsection

{{-- Modal Tambah --}}
<div class="modal fade" id="tambahMapelModal" tabindex="-1" aria-labelledby="tambahMapelModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMapelModal">Tambah Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('managemapel.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaMapel" class="form-label">Masukan mata pelajaran baru</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel">
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
