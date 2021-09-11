<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeLanguage($query)
    {
        $locale = Session::get('APP_LOCALE');
        return $query->where('language', $locale);
    }
}
