@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Questions</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._message')
                    @foreach ($questions as $item)
                       <div class="media">
                           <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $item->votes_count }}</strong> {{ Illuminate\Support\Str::plural('vote', $item->votes_count) }}
                                </div>
                                <div class="status {{ $item->status }}">
                                    <strong>{{ $item->answers_count }}</strong> {{ Illuminate\Support\Str::plural('answer', $item->answers_count) }}
                                </div>
                                <div class="view">
                                    {{ $item->views ." ". Illuminate\Support\Str::plural('view', $item->views) }}
                                </div>
                           </div>
                           <div class="media-body">
                               <div class="d-flex align-items-center">
                                   <a href="{{ $item->url }}"><h3 class="mt-0">{{ $item->title }}</h3></a>
                                   <div class="ml-auto">
                                        @can('update', $item)
                                            <a href="{{ route('questions.edit', $item->id) }}" class="btn btn-outline-info btn-sm">Edit Question</a>   
                                        @endcan

                                        @can('delete', $item)
                                            <form class="form-delete" action="{{ route('questions.destroy', $item->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure Want Delete This Question?')">Delete</button>
                                            </form>
                                        @endcan
                                   </div>
                               </div>
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
