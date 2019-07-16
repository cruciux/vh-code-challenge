@extends('layouts.master')

@section('title', 'Questions')

@section('content')
    <h4>{{ $question->value }}</h4>
    
    <p>{{ count($question->answers) }} answer{{ count($question->answers) === 1 ? '' : 's' }}</p>


    <h5>Answer the question</h5>
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