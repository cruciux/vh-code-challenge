<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([   
            'value' => 'required|max:255|min:5|ends_with:?',
        ], [
            'value.required' => 'Please enter your question',
            'value.min' => 'Your question must be longer than 5 characters',
            'value.ends_with' => 'Your question must end with a question mark',
        ]);

        \App\Question::create($validatedData);

        return redirect()->back()->with('message', 'Your question has been successfully posted!');
    }

    public function view($id, Request $request)
    {
        $question = \App\Question::find($id);

        return view('question', [
            'question' => $question,
        ]);
    }

    public function answerStore($id, Request $request)
    {
        $validatedData = $request->validate([
            'value' => 'required|max:255|min:5',
        ], [
            'value.required' => 'Please enter your answer',
            'value.min' => 'Your answer must be longer than 5 characters',
        ]);

        $question = \App\Question::find($id);
        $comment = $question->answers()->create($validatedData);

        return redirect()->back()->with('message', 'Your answer has been successfully posted!');
    }
}
