@extends('guru.guru_master')

@section('guru')
<div class="container py-5">
    <h3 class="mb-4 fw-bold text-primary">
        ✏️ Penilaian Jawaban Tugas: <span class="text-dark">{{ $tugas->judul }}</span>
    </h3>

    <div id="alertPlaceholder"></div> <!-- Tempat untuk alert sukses -->

    @if ($jawaban->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle me-2"></i>
            Belum ada jawaban yang dikumpulkan oleh siswa.
        </div>
    @else
        <!-- Search Box -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari nama siswa...">
        </div>

        <div class="table-responsive shadow-sm rounded bg-white">
            <table class="table table-hover align-middle mb-0" id="jawabanTable">
                <thead class="table-primary">
                    <tr>
                        <th>👤 Nama Siswa</th>
                        <th>🕒 Waktu Pengumpulan</th>
                        <th>📄 File Jawaban</th>
                        <th>📊 Nilai</th>
                        <th>📝 Catatan</th>
                        <th class="text-center">💾 Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jawaban as $item)
                        <tr data-jawaban-id="{{ $item->id }}">
                            <td class="fw-semibold nama-siswa">{{ $item->siswa->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_kumpul)->translatedFormat('d F Y H:i') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $item->file_jawaban) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-file-earmark-text"></i> Lihat
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('guru.tugas.berinilai', $item->id) }}" method="POST" class="nilai-form d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="nilai" class="form-control form-control-sm nilai-input" value="{{ $item->nilai ?? '' }}" min="0" max="100" required style="width: 80px;">
                            </td>
                            <td>
                                    <textarea name="catatan" class="form-control form-control-sm catatan-input" rows="2" placeholder="Tulis catatan..." style="min-width: 200px;">{{ $item->catatan }}</textarea>
                            </td>
                            <td class="text-center">
                                    <button type="submit" class="btn btn-success btn-sm simpan-btn">
                                        <i class="bi bi-check2-circle"></i> Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Tugas
        </a>
    </div>
</div>

<!-- Script Pencarian -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Search filter
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#jawabanTable tbody tr');

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        tableRows.forEach(row => {
            const nama = row.querySelector('.nama-siswa').textContent.toLowerCase();
            row.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });

    // AJAX submit untuk tiap form nilai
    const nilaiForms = document.querySelectorAll('.nilai-form');
    nilaiForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const actionUrl = this.action;

            // Disable tombol simpan agar tidak spam klik
            const btnSimpan = this.querySelector('.simpan-btn');
            btnSimpan.disabled = true;
            btnSimpan.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not OK');
                return response.json();
            })
            .then(data => {
                if(data.success) {
                    // Update nilai dan catatan di form dengan data terbaru
                    this.querySelector('input[name="nilai"]').value = data.nilai;
                    this.querySelector('textarea[name="catatan"]').value = data.catatan;

                    showAlert('Nilai berhasil disimpan.', 'success');
                } else {
                    showAlert('Gagal menyimpan nilai.', 'danger');
                }
            })
            .catch(() => {
                showAlert('Terjadi kesalahan saat menyimpan nilai.', 'danger');
            })
            .finally(() => {
                btnSimpan.disabled = false;
                btnSimpan.innerHTML = '<i class="bi bi-check2-circle"></i> Simpan';
            });
        });
    });

    // Fungsi tampilkan alert bootstrap di atas tabel
    function showAlert(message, type = 'success') {
        const alertPlaceholder = document.getElementById('alertPlaceholder');
        alertPlaceholder.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }
});
</script>
@endpush
@endsection
