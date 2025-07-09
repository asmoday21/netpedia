<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    //
    public function submit(Request $request)
    {
        $score = 0;

        if ($request->q1 == '7') $score++;
        if ($request->q2 == 'TCP/IP') $score++;

        // Simpan ke DB
        QuizResult::updateOrCreate(
            ['user_id' => Auth::id()],
            ['score' => $score]
        );

        return response()->json([
            'score' => $score,
            'message' => match ($score) {
                2 => 'Luar biasa! Kamu hebat.',
                1 => 'Bagus, tapi masih bisa lebih baik.',
                default => 'Ayo semangat belajar lagi!'
            }]
        );
    }

    public function leaderboard()
    {
        $results = QuizResult::with('user')
                    ->orderByDesc('score')
                    ->orderBy('updated_at')
                    ->take(10)
                    ->get();

        // Ambil nama user dan skor sebagai array
        $usernames = $results->map(fn($r) => $r->user->name)->toArray();
        $scores = $results->pluck('score')->toArray();

        return view('guru.quiz.leaderboard', compact('results', 'usernames', 'scores'));
    }

    public function leaderboardData()
    {
        $results = \App\Models\QuizResult::with('user')
                    ->orderByDesc('score')
                    ->orderBy('updated_at')
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'name' => $item->user->name,
                            'score' => $item->score,
                        ];
                    });

        return response()->json($results);
    }

    public function progressChart()
    {
        $results = \App\Models\QuizResult::with('user')
            ->orderBy('updated_at')
            ->get()
            ->groupBy('user.name');

        $labels = [];
        $datasets = [];

        foreach ($results as $name => $attempts) {
            if (count($labels) < count($attempts)) {
                $labels = $attempts->map(fn($res) => $res->updated_at->format('d M H:i'))->toArray();
            }

            $datasets[] = [
                'label' => $name,
                'data' => $attempts->pluck('score')->toArray(),
                'fill' => false,
                'borderColor' => '#' . substr(md5($name), 0, 6),
                'tension' => 0.3,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return view('guru.quiz.progress', compact('labels', 'datasets'));
    }

        public function show($id)
    {
        $result = QuizResult::with('user')->findOrFail($id);

        if ($result->user_id !== Auth::id()) {
            abort(403, 'Unauthorized akses hasil quiz');
        }

        // Contoh data jawaban quiz (dummy, ganti sesuai DB kamu)
        $answers = [
            [
                'question' => 'Berapa hasil dari 3 + 4?',
                'user_answer' => '7',
                'correct_answer' => '7',
                'is_correct' => true,
            ],
            [
                'question' => 'Protokol apa yang digunakan pada TCP/IP?',
                'user_answer' => 'TCP/IP',
                'correct_answer' => 'TCP/IP',
                'is_correct' => true,
            ],
        ];

        // Ambil data progres skor untuk chart (misal 5 hasil quiz terakhir user ini)
        $progressResults = QuizResult::where('user_id', Auth::id())
                            ->orderBy('updated_at')
                            ->take(5)
                            ->get();

        $labels = $progressResults->map(fn($r) => $r->updated_at->format('d M H:i'))->toArray();
        $scores = $progressResults->pluck('score')->toArray();

        return view('siswa.quiz.show', compact('result', 'answers', 'labels', 'scores'));
    }




}
