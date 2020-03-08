<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{    
    /**
     * __construct 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * __invoke this method store new vote question to storage
     *
     * @param App\Question $question
     * @return Illuminate\Http\RedirectResponse
     */
    public function __invoke(Question $question)
    {
        $vote = (int) request()->vote;

        auth()->user()->voteQuestion($question, $vote);
        
        return back();
    }
}
