<div class="media post">
    @include('shared._vote', [
        'model' => $answer
    ])
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
                @include('shared._author', [
                    'model' => $answer,
                    'label' => 'answered'
                ])
            </div>
        </div>
    </div>
</div>