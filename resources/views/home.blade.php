@extends('layouts.master')

@section('title', 'Questions')

@section('content')
    <h4>Ask a question</h4>

    <form method="POST" action="{{ route('question.store') }}" class="mb-5">
        @csrf
        <div class="form-group">
            <textarea class="form-control" rows="2" name="value" placeholder="{{ $placeholderQuestion }}">{{ old('value') }}</textarea>
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

        <button type="submit" class="btn btn-primary">Submit your question</button>
    </form>

    @if (count($questions) > 0)
        <h4>Previously asked questions</h4>

        <div class="mt-4">
            @foreach ($questions as $question)
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    
                    <div>
                        <a href="{{ route('question.view', ['id' => $question->id]) }}" class="pr-2 text-dark">
                            {{ $question->value }}
                        </a>

                        <div class="text-muted small">Posted {{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</div>
                    </div>

                    <span class="badge badge-primary">
                        {{ count($question->answers) }} answer{{ count($question->answers) === 1 ? '' : 's' }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif
@stop