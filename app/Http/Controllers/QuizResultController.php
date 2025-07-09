<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizResult;

class QuizResultController extends Controller
{
    //

    public function leaderboard()
    {
        $results = QuizResult::with('user')
            ->orderByDesc('score')
            ->take(10)
            ->get();

        return view('guru.quiz.leaderboard', [
            'usernames' => $results->pluck('user.name'),
            'scores' => $results->pluck('score'),
        ]);
    }
    public function store(Request $request)
    {
        $score = $request->input('score');

        QuizResult::create([
            'user_id' => auth()->id(),
            'score' => $score,
        ]);

        return response()->json(['success' => true]);
    }

}
