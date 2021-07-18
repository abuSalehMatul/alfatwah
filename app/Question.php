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

    public static function getByCategory($categoryId)
    {
        $locale = Session::get('APP_LOCALE');
        return Question::where('status', 'active')
        ->where('language', $locale)
        ->where('category_id', $categoryId)
        ->orderBy('created_at', 'DESC')
        ->paginate(15);
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
