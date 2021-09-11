<?php

namespace App;

use App\Scopes\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Article extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public static function getArticleQueryObj()
    {
        return Article::active()
        ->language()
        ->orderBy('created_at', 'DESC');
    }
}
