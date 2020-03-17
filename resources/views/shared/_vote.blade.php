@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $uriSegment = 'questions';
    @endphp
@elseif($model instanceof App\Answer)
    @php
        $name = 'answer';
        $uriSegment = 'answers'
    @endphp
@endif
@php
    $formId = $name . '-' . $model->id
@endphp
<div class="d-fex flex-column votes-control">
    <a href="#" title="This {{ $name }} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault(); document.getElementById('upvote-{{ $formId }}').submit()">
        <i class="fa fa-caret-up fa-3x"></i>
    </a>
    <form action="{{ route("$uriSegment.votes", $model->id) }}" id="upvote-{{ $formId }}" method="POST" style="display:none">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a href="#" title="This {{ $name }} not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault(); document.getElementById('downvote-{{ $formId }}').submit()">
        <i class="fa fa-caret-down fa-3x"></i>
    </a>
    <form action="{{ route("$uriSegment.votes", $model->id) }}" id="downvote-{{ $formId }}" method="POST" style="display:none">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if ($model instanceof App\Question)
        @include('shared._favorited', [
            'model' => $model
        ])
    @elseif($model instanceof App\Answer)
        @include('shared._acceptAnswer', [
            'model' => $model
        ])
    @endif
</div>