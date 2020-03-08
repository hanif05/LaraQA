<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
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
     * __invoke this method is store new vote answer to storage
     *
     * @param  App\Answer $answer
     * @return Illuminate\Http\RedirectResponse
     */
    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;

        auth()->user()->voteAnswer($answer, $vote);

        return back();
    }
}
