@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Questions</div>

                <div class="card-body">
                   @foreach ($questions as $item)
                       <div class="media">
                           <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $item->votes }}</strong> {{ Illuminate\Support\Str::plural('vote', $item->votes) }}
                                </div>
                                <div class="status">
                                    <strong>{{ $item->answers }}</strong> {{ Illuminate\Support\Str::plural('answer', $item->answers) }}
                                </div>
                                <div class="view">
                                    {{ $item->views ." ". Illuminate\Support\Str::plural('view', $item->views) }}
                                </div>
                           </div>
                           <div class="media-body">
                               <a href="{{ $item->url }}"><h3 class="mt-0">{{ $item->title }}</h3></a>
                               <p class="lead">
                                   Asked by
                                    <a href="{{ $item->user->url }}">{{ $item->user->name }}</a>
                                    <small class="text-muted">{{ $item->created_date }}</small>
                               </p>
                                {!! Illuminate\Support\Str::limit($item->body,250) !!}
                           </div>
                       </div>
                       <hr>
                   @endforeach
                   {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
