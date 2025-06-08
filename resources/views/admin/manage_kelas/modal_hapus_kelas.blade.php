<div class="modal fade" id="hapusKelas-{{ $kelas_item->id }}" tabindex="-1"
    aria-labelledby="hapuKelas-{{ $kelas_item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="hapuKelas-{{ $kelas_item->id }}">Hapus Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Form -->
            <form action="{{ route('managekelas.destroy', $kelas_item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Peringatan!</h5>
                        <p class="mb-0">
                            Menghapus kelas <u>{{ $kelas_item->nama_kelas }}</u> akan
                            <strong>secara permanen menghapus</strong> semua data siswa yang terkait dengan kelas ini.
                            Tindakan ini <strong>tidak dapat dibatalkan</strong>!
                        </p>
                    </div>
                    <h5 class="mt-3">Yakin ingin menghapus kelas ini?</h5>
                    <p class="text-muted mt-2">
                        Tombol Hapus aktif dalam <span id="countdown-{{ $kelas_item->id }}">10</span> detik
                    </p>
                    <div class="progress" style="height: 10px;">
                        <div id="progressBar-{{ $kelas_item->id }}" class="progress-bar bg-danger" role="progressbar"
                            style="width: 100%; transition: width 1s linear;" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="hapusBtn-{{ $kelas_item->id }}"
                        disabled>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                // Cari tombol Hapus, countdown, dan progress bar
                const hapusBtn = this.querySelector('button[id^="hapusBtn-"]');
                const countdown = this.querySelector('span[id^="countdown-"]');
                const progressBar = this.querySelector('div[id^="progressBar-"]');

                if (hapusBtn && countdown && progressBar) {
                    hapusBtn.disabled = true;
                    let timeLeft = 10;
                    countdown.textContent = timeLeft;
                    progressBar.style.width = '100%';

                    // Update countdown dan progress bar setiap detik
                    const timer = setInterval(() => {
                        timeLeft--;
                        countdown.textContent = timeLeft;
                        progressBar.style.width = (timeLeft * 10) +
                            '%'; // 100% -> 0% dalam 10 detik
                        if (timeLeft <= 0) {
                            clearInterval(timer);
                            hapusBtn.disabled = false;
                            progressBar.parentElement.style.display =
                                'none'; // Sembunyikan progress bar
                            countdown.parentElement.style.display =
                                'none'; // Sembunyikan teks
                        }
                    }, 1000);
                }
            });
        });
    });
</script>
