<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Question
 */
class Question extends Model
{    
    /**
     * Question::fillable
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];
    
    /**
     * Question::user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Question::answer
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    /**
     * Question::favorites
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    
    /**
     * Question::votes
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
    
    /**
     * Question::acceptBestAnswer
     *
     * @param  mixed $answer
     * @return void
     */
    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }
    
    /**
     * Question::isFavorited
     *
     * @return bool
     */
    public function isFavorited()
    {
        if (auth()->id()) {
            
            return $this->favorites()->where('user_id', auth()->user()->id)->count() > 0;
        }
        return false;
    }
    
    /**
     * Question::getIsFavoritedAttribute
     *
     * @return bool
     */
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
    
    /**
     * Question::getFavoritesCountAttribute
     *
     * @return mixed
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
    
    /**
     * Question::setTitleAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    /**
     * Question::getUrlAttribute
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }
    
    /**
     * Question::getCreatedDateAttribute
     *
     * @return mixed
     */
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    /**
     * Question::getStatusAttribute
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    
    /**
     * Question::getBodyHtmlAttribute
     *
     * @return string
     */
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
}
