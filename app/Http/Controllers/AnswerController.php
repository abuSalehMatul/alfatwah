<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Question;

class AnswerController extends Controller
{
    public function newAnswers()
    {  
        $locale = Session::get('APP_LOCALE');
        return Answer::active()
        ->language()
        ->orderBy('created_at', 'DESC')
        ->limit(10)->get();
    }

    public function getList($lang)
    {
        $locale = Session::get('APP_LOCALE');
        $answers = Answer::active()->language()
        ->orderBy('created_at', 'DESC')->paginate(25);
        return view('frontend.answer_list')->with('answers', $answers);
    }

    public function findAnswer($lang , $batchId)
    {
        $answer = Answer::where('batch_id', $batchId)->first();
        $fun = "answer_". $lang;
        $questionWithAns = Question::findOrFail($answer->question_id)->load($fun);
        return view('frontend.questionAns')->with('questionAnswer', $questionWithAns);
    }
}
