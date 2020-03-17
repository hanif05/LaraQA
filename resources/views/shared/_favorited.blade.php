<a href="#" class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}" title="Click to mark as favorite question (Click again to undo)"
    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit()">
    <i class="fa fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
    {{-- $model->favorites_count same with $model->favorites()->count() --}}
</a>
<form action="/questions/{{ $model->id }}/favorites" id="favorite-question-{{ $model->id }}" method="POST" style="display:none">
    @csrf
    @if ($model->is_favorited)
        @method('DELETE')
    @endif
</form>