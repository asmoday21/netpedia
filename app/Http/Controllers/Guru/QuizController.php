<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('user_id', auth()->id())->latest()->get();
        return view('guru.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('guru.quiz.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'platform' => 'required|string',
            'link' => 'required|url'
        ]);

        $validated['user_id'] = auth()->id();

        Quiz::create($validated);

        return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil ditambahkan!');
    }

    public function edit(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);
        return view('guru.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'platform' => 'required|string',
            'link' => 'required|url'
        ]);

        $quiz->update($validated);

        return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);

        if ($quiz->user_id !== auth()->id()) {
            abort(403);
        }

        $quiz->delete();

        return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil dihapus.');
    }

    private function authorizeQuiz(Quiz $quiz)
    {
        if ($quiz->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak');
        }
    }
}
