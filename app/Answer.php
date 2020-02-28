<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function isBest()
    {
        return $this->question->best_answer_id == $this->id;
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function getStatusAttribute()
    {
        return  $this->isBest() ? 'votes-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

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
