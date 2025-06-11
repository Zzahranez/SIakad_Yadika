<div class="tab-pane fade" id="perbaruikelas" role="tabpanel" aria-labelledby="perbaruikelas-tab">
    <div class="card py-4 shadow-lg border-0 rounded-3">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <!-- Class Selection Form -->
                    <div class="form-group mb-3">
                        <label for="kelas_id" class="form-label fw-bold text-dark">
                            <i class="fas fa-chalkboard me-2"></i>Pilih Kelas
                        </label>
                        <select class="form-select shadow-sm" name="kelas_id" id="kelas_id">
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($kelas_all as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Student Content -->
                    <div id="student-content">
                        <div class="card text-center border-info shadow-lg rounded-3 p-4">
                            <div class="card-body">
                                <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                                <h4 class="card-title text-info fw-bold">Pilih Kelas</h4>
                                <p class="card-text">Silakan pilih kelas untuk mengupdate kelas siswa.</p>
                            </div>
                        </div>
                    </div>

                    {{-- End Of colom --}}

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('kelas_id').addEventListener('change', function() {
        let kelasId = this.value;
        let content = document.getElementById('student-content');

        if (!kelasId) {
            content.innerHTML = `
            <div class="card text-center border-info shadow-sm rounded-3 p-4">
                <div class="card-body">
                    <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                    <h4 class="card-title text-info fw-bold">Pilih Kelas</h4>
                    <p class="card-text">Silakan pilih kelas untuk mengupdate kelas siswa.</p>
                </div>
            </div>`;
            return;
        }

        // Tampilkan loading spinner
        content.innerHTML = `
        <div class="text-center my-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Memuat data siswa...</p>
        </div>`;

        fetch('/managekelas?kelas_id=' + kelasId + '&action=siswa', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                if (data.siswa.length > 0) {
                    content.innerHTML = `
                    <form action="{{ route('managekelas.naikKelas') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kelas_lama_id" value="${kelasId}">
                        
                        <div class="card mb-4 shadow-lg">
                            <div class="card-header bg-birumantap text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Daftar Siswa</h5>
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="check-all" class="form-check-input" role="switch"> 
                                    <label class="form-check-label text-white" for="check-all">Pilih Semua</label>
                                </div>
                            </div>
                            
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col" class="text-center">Pilih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${data.siswa.map((s, index) => `
                                                                        <tr class="student-row" data-id="${s.id}">
                                                                            <td class="text-center">${index + 1}</td>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="bg-birumantap text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                                                        ${s.nama.charAt(0).toUpperCase()}
                                                                                    </span>
                                                                                    <span>${s.nama}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input type="checkbox" name="siswa_ids[]" value="${s.id}" 
                                                                                    class="form-check-input student-checkbox" id="student-${s.id}">
                                                                            </td>
                                                                        </tr>
                                                                    `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-birumantap rounded-pill">${data.siswa.length}</span> siswa ditemukan
                                </div>
                                <div class="fw-bold" id="selected-counter">
                                    0 siswa dipilih
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 shadow-lg ">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-arrow-up me-2"></i>Naikkan ke Kelas</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select" name="kelas_baru_id" id="kelas_baru_id" required>
                                    <option value="" selected disabled>-- Pilih Kelas Tujuan --</option>
                                    ${data.kelas.map(k => `
                                                                <option value="${k.id}">${k.nama_kelas}</option>
                                                            `).join('')}
                                </select>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-success" id="submit-btn" disabled>
                                    <i class="fas fa-check-circle me-2"></i>Naikkan Siswa
                                </button>
                            </div>
                        </div>
                    </form>`;

                    // Tambah event listener untuk "Pilih Semua"
                    document.getElementById('check-all').addEventListener('change', function() {
                        let isChecked = this.checked;
                        let checkboxes = document.querySelectorAll('.student-checkbox');

                        checkboxes.forEach(checkbox => {
                            checkbox.checked = isChecked;
                        });

                        updateSelectedCounter();
                        updateSubmitButton();
                    });

                    // Tambah event listener untuk baris tabel
                    document.querySelectorAll('.student-row').forEach(row => {
                        row.addEventListener('click', function(e) {
                            // Jangan trigger jika yang diklik adalah checkbox
                            if (e.target.type !== 'checkbox') {
                                let checkbox = this.querySelector('.student-checkbox');
                                checkbox.checked = !checkbox.checked;
                                updateSelectedCounter();
                                updateSubmitButton();
                            }
                        });
                    });

                    // Tambah event listener untuk checkbox
                    document.querySelectorAll('.student-checkbox').forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            updateSelectedCounter();
                            updateSubmitButton();
                        });
                    });

                    // Tambah event listener untuk dropdown kelas tujuan
                    document.getElementById('kelas_baru_id').addEventListener('change', function() {
                        updateSubmitButton();
                    });

                    // Fungsi untuk update counter siswa yang dipilih
                    function updateSelectedCounter() {
                        let selectedCount = document.querySelectorAll('.student-checkbox:checked').length;
                        let counter = document.getElementById('selected-counter');
                        counter.textContent = selectedCount + ' siswa dipilih';

                        if (selectedCount > 0) {
                            counter.classList.add('text-success');
                            counter.classList.remove('text-primary');
                        } else {
                            counter.classList.add('text-primary');
                            counter.classList.remove('text-success');
                        }
                    }

                    // Fungsi untuk mengaktifkan/menonaktifkan tombol submit
                    function updateSubmitButton() {
                        let selectedCount = document.querySelectorAll('.student-checkbox:checked').length;
                        let kelasSelected = document.getElementById('kelas_baru_id').value !== '' &&
                            document.getElementById('kelas_baru_id').value !== null;
                        let submitBtn = document.getElementById('submit-btn');

                        if (selectedCount > 0 && kelasSelected) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    }

                } else {
                    content.innerHTML = `
                    <div class="card text-center border-warning shadow-sm">
                        <div class="card-body p-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h4 class="card-title text-warning fw-bold">Tidak Ada Siswa</h4>
                            <p class="card-text">Tidak ada siswa pada kelas ini. Silakan tambah siswa atau pilih kelas lain.</p>
                        </div>
                    </div>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                content.innerHTML = `
                <div class="card text-center border-danger shadow-sm">
                    <div class="card-body p-4">
                        <i class="fas fa-exclamation-circle fa-3x text-danger mb-3"></i>
                        <h4 class="card-title text-danger fw-bold">Error</h4>
                        <p class="card-text">Gagal memuat data siswa. Silakan coba lagi.</p>
                        <button class="btn btn-outline-danger mt-2" onclick="document.getElementById('kelas_id').dispatchEvent(new Event('change'))">
                            <i class="fas fa-sync me-2"></i>Coba Lagi
                        </button>

                    </div>
                </div>`;
            });
    });
</script>
