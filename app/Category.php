<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function scopeGetTopLevel($query)
    {
    	return $query->where('parent_id', null);
    }

    public function getNameAttribute()
    {
    	$language = app()->getLocale();
    	return $this->{'name_'.$language} ?? '';
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
