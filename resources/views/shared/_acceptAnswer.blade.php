@can('accept', $model)
    <a class="favorite mt-2 {{ $model->status }}" title="Click this to mark as favorite answer"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit()"
        >
        <i class="fa fa-check fa-2x"></i>
    </a>
    <form action="{{ route('answers.accept', $model->id) }}" id="accept-answer-{{ $model->id }}" method="POST" style="display:none">
        @csrf
    </form>
@else
    @if ($model->is_best)
        <a class="favorite mt-2 {{ $model->status }}" title="The owner question mark this as favorite answer">
            <i class="fa fa-check fa-2x"></i>
        </a>
    @endif
@endcan