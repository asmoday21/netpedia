<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return view('siswa.quiz.index', compact('quizzes'));
    }

    public function open($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->increment('views'); // Naikkan counter
        return redirect()->away($quiz->link); // Redirect langsung ke link
    }

}

