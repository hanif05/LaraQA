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
                    @forelse ($questions as $item)
                       @include('questions._question')
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> There is no questions avaliable!
                        </div>
                    @endforelse
                   {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
