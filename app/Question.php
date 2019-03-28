<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];
    //protected $appends = ['created_date', 'is_favorited', 'favorites_count', 'body_html'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute()
    {
        return route("questions.show", $this->id);
    }

    public function getCreatedDateAttribute()
    {
        //return $this->created_at->diffForHumans();
        return $this->created_at->format("d-M-Y");
    }
}
