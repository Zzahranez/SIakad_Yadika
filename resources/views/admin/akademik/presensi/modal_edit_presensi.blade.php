 <div class="modal fade" id="editPresenModal-{{ $presen->id }}" tabindex="-1" aria-labelledby="modalTitle-#"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <!-- Header -->
             <div class="modal-header">
                 <h5 class="modal-title" id="modalTitle-#">Edit Presensi
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <!-- Form -->
             <form action="{{route('managepresensi.update', $presen->id)}}" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="modal-body">
                     <div class="mb-3">
                         <ul class="list-group mb-3">
                             <li class="list-group-item me-2">
                                 <span><i class="fas fa-user-graduate text-info me-2"></i>Nama Siswa :</span>
                                 <strong>{{ $presen->siswa->nama }}</strong>
                             </li>
                             <li class="list-group-item me-2">
                                 <span><i class="fas fa-chalkboard-teacher text-success me-2"></i>Guru Mengajar :</span>
                                 <strong>{{ $presen->pertemuan->pembelajaran->guru->nama }}</strong>
                             </li>
                             <li class="list-group-item me-2">
                                 <span><i class="fas fa-school text-primary me-2"></i>Kelas :</span>
                                 <strong>{{ $presen->pertemuan->pembelajaran->kelas->nama_kelas }}</strong>
                             </li>
                             <li class="list-group-item me-2">
                                 <span><i class="fas fa-book text-warning me-2"></i>Mata Pelajaran :</span>
                                 <strong>{{ $presen->pertemuan->pembelajaran->mapel->nama_mapel }}</strong>
                             </li>
                         </ul>
                     </div>

                     <div class="mb-3">
                         <label for="tanggal" class="form-label">Tanggal
                             pertemuan</label>
                         <input type="date" class="form-control" id="tanggal" name="tanggal"
                             value="{{ $presen->pertemuan->tanggal }}" required>
                     </div>

                     <!-- Input Status -->
                     <div class="mb-3">
                         <label for="status_absensi" class="form-label">Status absensi siswa</label>
                         <select name="status" class="form-select">
                             @foreach (['hadir', 'izin', 'alpha'] as $status)
                                 <option value="{{ $status }}" {{ $presen->status == $status ? 'selected' : '' }}>
                                     {{ ucfirst($status) }}
                                 </option>
                             @endforeach
                         </select>

                         </select>
                     </div>

                     <!-- Footer -->
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-primary">Simpan</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
