<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $placeholderQuestions = [
            "Isn't it expensive to be vegan?",
            "Doesn't the bible endorse eating animals?",
            "Haven't we evolved to eat meat?",
            "What would happen to all the animals if we stopped eating them?",
        ];

        $questions = \App\Question::all();

        return view('home', [
            'placeholderQuestion' => $placeholderQuestions[array_rand($placeholderQuestions, 1)],
            'questions' => $questions,
        ]);
    }
}

