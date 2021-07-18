<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Article;

class ArticleController extends Controller
{
    public function getShortList()
    {
        $locale = Session::get('APP_LOCALE');
        return Article::where('status', 'active')
        ->where('language', $locale)
        ->orderBy('created_at', 'DESC')
        ->limit(8)
        ->get();
    }

    public function show($lang, $id)
    {
        $article = Article::findOrFail($id);
        return view('frontend.article')->with('article', $article);
    }

    public function getAll($lang)
    {
        $articles = Article::where('language', $lang)->where('status', 'active')->paginate(15);
        return view('frontend.all_article')->with('articles', $articles);
    }
}
