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