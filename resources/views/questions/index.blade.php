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
                           <div class="media-body">
                                <h3 class="mt-0">{{ $item->title }}</h3>
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
