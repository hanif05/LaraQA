<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * User::questions
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    /**
     * User::answers
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    /**
     * User::favorites
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }
    
    /**
     * User::voteQuestions
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }
    
    /**
     * User::voteAnswers
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }
    
    /**
     * User::voteQuestion this is logic for vote question
     *
     * @param  App\Question $question
     * @param  mixed $vote
     * @return void
     */
    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();

        if ($voteQuestions->where('votable_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question, ['vote' => $vote]);
        } else {
            $voteQuestions->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');
        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question->upVotes()->sum('vote');

        $question->votes_count = $upVotes + $downVotes;
        $question->save();

    }
    
    /**
     * User::getUrlAttribute
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        // return route('users.show', $this->id);

        return "#";
    }
    
    /**
     * User::getAvatarAttribute
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 30;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
}
