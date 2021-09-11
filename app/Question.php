<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Question extends Model
{
    //
    protected $guarded = ['id'];

    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
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

    public static function getByCategory($categoryId)
    {
        return Question::active()
        ->language()
        ->where('category_id', $categoryId)
        ->orderBy('created_at', 'DESC')
        ->paginate(15);
    }

    public static function getSelectedQuestionQueryObj()
    {
        return Question::where('is_selected', 1)
        ->active()
        ->language()
        ->orderBy('created_at', 'DESC')
        ->with(['answers' => function($query){
            $query->language()->active();
        }]);
    }

    public function answer_bn()
    {
    	return $this->hasOne('App\Answer')->where('language', 'bn');
    }
    public function answer_en()
    {
    	return $this->hasOne('App\Answer')->where('language', 'en');
    }
    public function answer_ar()
    {
    	return $this->hasOne('App\Answer')->where('language', 'ar');
    }
}
