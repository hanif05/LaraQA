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

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function getStatusAttribute()
    {
        return $this->question->best_answer_id == $this->id ? 'votes-accepted' : '';
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers_count'); //increase answers_count every time answers create
        });
        static::deleted(function ($answer) {
            $question = $answer->question;
            $question->decrement('answers_count'); // decrease answers_count every time answer deleted
            if ($question->best_answer_id == $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });
    }
}
