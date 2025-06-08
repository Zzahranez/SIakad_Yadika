<div class="modal fade" id="editPembModal-{{ $item_pemb->id }}" tabindex="-1"
    aria-labelledby="modalTitle-{{ $item_pemb->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle-{{ $item_pemb->id }}">Edit Jadwal Mengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('managepembelajaran.update', $item_pemb->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        {{-- Input --}}
                        <div class="mb-3">
                            <label for="kelasId" class="form-label">Pilih Kelas</label>
                            <select class=" form-select" id="kelas_id" name="kelas_id">

                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $k->id == $item_pemb->kelas_id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="guruId" class="form-label">Pilih Guru</label>
                            <select class=" form-select" id="guru_id" name="guru_id">

                                @foreach ($guru as $g)
                                    <option value="{{ $g->id }}"
                                        {{ $g->id == $item_pemb->guru_id ? 'selected' : '' }}>{{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mapelId" class="form-label">Pilih Mata Pelajaran</label>
                            <select class=" form-select" id="mapel_id" name="mapel_id">
                                @foreach ($mapels as $m)
                                    <option value="{{ $m->id }}"
                                        {{ $m->id == $item_pemb->mapel_id ? 'selected' : '' }}>
                                        {{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
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
