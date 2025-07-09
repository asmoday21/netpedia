@extends('siswa.siswa_master')

@section('siswa')
<div class="container my-4">
    <h3>Detail Hasil Quiz</h3>
    <div class="card shadow-sm p-4 mb-4">
        <p><strong>Nama:</strong> {{ $result->user->name }}</p>
        <p><strong>Skor:</strong> {{ $result->score }}</p>
        <p><strong>Waktu Submit:</strong> {{ $result->updated_at->format('d M Y H:i') }}</p>
    </div>

    {{-- Grafik Progres Skor --}}
    <div class="card shadow-sm p-4 mb-4">
        <h5>Progres Skor Terakhir</h5>
        <canvas id="progressChart" height="100"></canvas>
    </div>

    {{-- Review Jawaban --}}
    <div class="card shadow-sm p-4">
        <h5>Review Jawaban</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th>Jawaban Kamu</th>
                    <th>Jawaban Benar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($answers as $item)
                <tr class="{{ $item['is_correct'] ? 'table-success' : 'table-danger' }}">
                    <td>{{ $item['question'] }}</td>
                    <td>{{ $item['user_answer'] }}</td>
                    <td>{{ $item['correct_answer'] }}</td>
                    <td>
                        @if ($item['is_correct'])
                            <span class="badge bg-success">Benar</span>
                        @else
                            <span class="badge bg-danger">Salah</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('siswa.quiz.leaderboard') }}" class="btn btn-primary mt-4">Kembali ke Leaderboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('progressChart').getContext('2d');
const progressChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Skor Quiz',
            data: {!! json_encode($scores) !!},
            fill: false,
            borderColor: 'rgba(75, 192, 192, 0.8)',
            tension: 0.3,
            pointRadius: 5,
            pointHoverRadius: 7,
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'nearest',
            intersect: false,
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 10
            }
        }
    }
});
</script>
@endsection
