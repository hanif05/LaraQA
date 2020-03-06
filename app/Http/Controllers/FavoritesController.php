<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

/**
 * Class FavoritesController
 */
class FavoritesController extends Controller
{    
    /**
     * this is middleware auth
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Store a newly created favorite question in storage.
     *
     * @param  App\Question $question
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Question $question)
    {
        $question->favorites()->attach(auth()->id());

        return back();
    }
    
    /**
     * Remove a favorited question from storage
     *
     * @param  App\Question $question
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());

        return back();
    }
}
