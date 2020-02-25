<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answers</h3>
                </div>
                <hr>

                <form action="{{ route('questions.answers.store', $question->id) }}" method="post" class="">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="" cols="30" rows="7" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>