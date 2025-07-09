@extends('siswa.siswa_master')
@section('siswa')
    <div class="container">
    <h4 class="mb-4">📈 Grafik Progres Siswa</h4>
    <canvas id="progressChart" height="120"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('progressChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!}
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, max: 2 },
                x: { ticks: { autoSkip: true, maxTicksLimit: 10 } }
            }
        }
    });
</script>
@endsection