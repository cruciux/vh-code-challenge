@extends('layouts.master')

@section('title', 'Questions')

@section('content')
    <h4>{{ $question->value }}</h4>

    <div class="text-muted small">Posted {{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</div>

    @if (count($question->answers) > 0)
        <h5 class="mt-5">Current answers</h5>

        <div class="mt-3">
            @foreach ($question->answers as $answer)
                <div class="justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div>{{ $answer->value }}</div>
                    <span class="text-muted small">Posted {{ Carbon\Carbon::parse($answer->created_at)->diffForHumans() }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <h5 class="mt-5">Answer the question</h5>
    <form method="POST" action="{{ route('question.answer.store', ['id' => $question->id]) }}" class="">
        @csrf
        <div class="form-group">
            <textarea class="form-control" rows="2" name="value" placeholder="Enter your answer">{{ old('value') }}</textarea>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Submit your answer</button>
    </form>
@stop