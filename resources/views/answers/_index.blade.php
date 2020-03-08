<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('answer', $answersCount)}}</h2>
                </div>
                <hr>
                
                @include('layouts._message')

                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-fex flex-column votes-control">
                            <a href="#" title="This answer is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('answer-upvote-{{ $answer->id }}').submit()">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <form action="{{ route('answers.votes', $answer->id) }}" id="answer-upvote-{{ $answer->id }}" method="POST" style="display:none">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a href="#" title="This answer not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('answer-downvote-{{ $answer->id }}').submit()">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <form action="{{ route('answers.votes', $answer->id) }}" id="answer-downvote-{{ $answer->id }}" method="POST" style="display:none">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            @can('accept', $answer)
                                <a class="favorite mt-2 {{ $answer->status }}" title="Click this to mark as favorite answer"
                                    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit()"
                                    >
                                    <i class="fa fa-check fa-2x"></i>
                                </a>
                                <form action="{{ route('answers.accept', $answer->id) }}" id="accept-answer-{{ $answer->id }}" method="POST" style="display:none">
                                    @csrf
                                </form>
                            @else
                                @if ($answer->is_best)
                                    <a class="favorite mt-2 {{ $answer->status }}" title="The owner question mark this as favorite answer">
                                        <i class="fa fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [ $question->id , $answer->id ]) }}" class="btn btn-outline-info btn-sm">Edit Answer</a>   
                                        @endcan

                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [ $question->id , $answer->id ]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure Want Delete This Answer?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>                                    
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
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
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>