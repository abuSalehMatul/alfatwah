<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Article;

class ArticleController extends Controller
{
    public function getShortList()
    {
        return Article::getArticleQueryObj()
        ->limit(10)
        ->get();
    }

    public function show($lang, $id)
    {
        $article = Article::findOrFail($id);
        return view('frontend.article')->with('article', $article);
    }

    public function getAll($lang)
    {
        $articles = Article::getArticleQueryObj()->paginate(25);
        return view('frontend.all_article')->with('articles', $articles);
    }
}
