@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-fex flex-column votes-control">
                            <a href="#" title="This question is useful" class="vote-up">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">123</span>
                            <a href="#" title="This question not useful" class="vote-down off">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <a href="#" class="favorite mt-2 favorited" title="Click to mark as favorite question (Click again to undo)">
                                <i class="fa fa-star fa-2x"></i>
                                <span class="favorites-count">12</span>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Question {{ $question->created_at->diffForHumans() }}</span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        <img src="{{ $question->user->avatar }}" alt="" srcset="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $question->answers_count . " " . Str::plural('answer', $question->answers_count)}}</h2>
                    </div>
                    <hr>

                    @foreach ($question->answers as $answer)
                        <div class="media">
                            <div class="d-fex flex-column votes-control">
                                <a href="#" title="This answer is useful" class="vote-up">
                                    <i class="fa fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">123</span>
                                <a href="#" title="This answer not useful" class="vote-down off">
                                    <i class="fa fa-caret-down fa-3x"></i>
                                </a>
                                <a href="#" class="favorite mt-2 votes-accepted" title="Click this to mark as favorite answer">
                                    <i class="fa fa-check fa-2x"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $answer->created_at->diffForHumans() }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="" srcset="">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
