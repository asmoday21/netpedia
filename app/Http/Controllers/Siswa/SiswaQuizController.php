<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

class SiswaQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->get(); // atau bisa difilter jika hanya quiz dari guru tertentu
        return view('siswa.quiz.index', compact('quizzes'));
    }
}
