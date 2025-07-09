<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        // Admin biasanya bisa lihat semua quiz
        $quizzes = Quiz::latest()->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'platform' => 'required|string',
            'link' => 'required|url'
        ]);

        // Bisa tetapkan user_id admin yang buat
        $validated['user_id'] = auth()->id();

        Quiz::create($validated);

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil ditambahkan!');
    }

    public function edit(Quiz $quiz)
    {
        // Jika perlu validasi akses admin terhadap quiz, aktifkan fungsi ini:
        // $this->authorizeQuiz($quiz);

        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        // $this->authorizeQuiz($quiz); // aktifkan jika ingin batasi akses edit

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'platform' => 'required|string',
            'link' => 'required|url'
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil diperbarui!');
    }

    public function destroy(Quiz $quiz)
    {
        // $this->authorizeQuiz($quiz); // aktifkan jika perlu batasi akses hapus

        $quiz->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dihapus.');
    }

    // Optional: jika ingin batasi admin akses quiz tertentu
    private function authorizeQuiz(Quiz $quiz)
    {
        if ($quiz->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak');
        }
    }
}
