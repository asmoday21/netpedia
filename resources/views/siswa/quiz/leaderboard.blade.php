@extends('siswa.siswa_master')

@section('siswa')
<style>
    .chart-container {
        max-width: 100%;
        overflow-x: auto;
        padding-bottom: 1rem;
    }
    #scoreChart {
        min-width: 350px;
        max-height: 300px;
        cursor: pointer;
    }
    /* Styling tambahan untuk halaman siswa */
    .container {
        padding-top: 1rem;
        padding-bottom: 2rem;
    }
    h4 {
        color: #2c3e50;
        font-weight: 700;
    }
</style>

<div class="container">
    <h4 class="mb-4">🏆 Leaderboard Kuis Siswa</h4>
    <div class="card shadow-sm p-3 bg-white rounded chart-container">
        <canvas id="scoreChart" height="300"></canvas>
    </div>
</div>

<!-- Modal detail user -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="detailModalLabel">Detail Skor Siswa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama:</strong> <span id="modalUserName"></span></p>
        <p><strong>Skor Tertinggi:</strong> <span id="modalUserScore"></span></p>
        <p><strong>Catatan:</strong></p>
        <ul id="modalUserDetails"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('scoreChart').getContext('2d');

    const usernames = {!! json_encode($usernames) !!};
    const scores = {!! json_encode($scores) !!};

    // Gradient biru ke transparan, lebih soft buat siswa
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(0, 123, 255, 0.85)');
    gradient.addColorStop(1, 'rgba(0, 123, 255, 0.3)');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: usernames,
            datasets: [{
                label: 'Skor Tertinggi',
                data: scores,
                backgroundColor: gradient,
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1,
                borderRadius: 6,
                maxBarThickness: 45,
                hoverBackgroundColor: 'rgba(0, 123, 255, 1)',
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            animation: { duration: 1000, easing: 'easeOutQuart' },
            plugins: {
                legend: { labels: { font: { size: 14, weight: '700' } } },
                tooltip: {
                    callbacks: {
                        label: ctx => `Skor: ${ctx.parsed.y}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 12 }, color: '#444' },
                    grid: { color: '#ddd', borderDash: [3, 3] }
                },
                x: {
                    ticks: { font: { size: 13, weight: '600' }, maxRotation: 75, minRotation: 45, color: '#222' },
                    grid: { display: false }
                }
            },
            onClick: (evt, elements) => {
                if (elements.length > 0) {
                    const idx = elements[0].index;
                    const username = usernames[idx];
                    const score = scores[idx];

                    document.getElementById('modalUserName').textContent = username;
                    document.getElementById('modalUserScore').textContent = score;

                    // Contoh detail tambahan, bisa disesuaikan dengan data dinamis
                    const details = [
                        `Terakhir update: {{ now()->format('d M Y') }}`,
                        'Terus berlatih dan raih skor terbaikmu!',
                    ];

                    const ul = document.getElementById('modalUserDetails');
                    ul.innerHTML = '';
                    details.forEach(text => {
                        const li = document.createElement('li');
                        li.textContent = text;
                        ul.appendChild(li);
                    });

                    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                    modal.show();
                }
            }
        }
    });
});
</script>
@endsection
