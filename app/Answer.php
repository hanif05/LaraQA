<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 */
class Answer extends Model
{    
    /**
     * Answer::fillable
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id'];
    
    /**
     * Answer::user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Answer::question
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    /**
     * Answer::votes
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
    
    /**
     * Answer::isBest
     *
     * @return bool
     */
    public function isBest()
    {
        return $this->question->best_answer_id == $this->id;
    }
    
    /**
     * Answer::downVote
     *
     * @return mixed
     */
    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }
    
    /**
     * Answer::upVote
     *
     * @return mixed
     */
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }
    
    /**
     * Answer::getBodyHtmlAttribute
     *
     * @return string
     */
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
    
    /**
     * Answer::getStatusAttribute
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        return  $this->isBest() ? 'votes-accepted' : '';
    }
    
    /**
     * Answer::getIsBestAttribute
     *
     * @return bool
     */
    public function getIsBestAttribute()
    {
        return $this->isBest();
    }
    
    /**
     * Answer::boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers_count'); //increase answers_count every time answers create
        });
        static::deleted(function ($answer) {
            $answer->question->decrement('answers_count'); // decrease answers_count every time answer deleted
        });
    }
}
