<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAll()
    {
        $questions = Question:: orderBy('created_at', 'DESC')->where('is_answered', 0)->paginate(20);
        return view('backend.questions')->with('questions', $questions);
    }

    public function answeredQuestions()
    {
        $questions = Question:: orderBy('created_at', 'DESC')->where('is_answered', 1)->paginate(20);
        return view('backend.answereduqestions')->with('questions', $questions);
    }

    public function allQuestions()
    {
        $questions = Question:: orderBy('created_at', 'DESC')->paginate(20);
        return view('backend.allQuestions')->with('questions', $questions);
    }

    public function answer($id)
    {
        return view('backend.answerForm')->with('id', $id);
    }

    public function find($id)
    {
        $question = Question::findOrFail($id);
        return view('backend.singleQuestion')->with('question', $question);
    }

    public function findApi($lang, $questionId)
    {
        $fun = "answer_". $lang;
        return $questionWithAns = Question::findOrFail($questionId)->load($fun);
    }
    public function saveEdit(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'description' =>  'required'
        ]);
        $question = Question::findOrFail($request->question_id);
        $question->title = $request->title;
        $question->description = $request->description;
        $question->save();
        return redirect()->route('admin.questions');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('backend.questionEdit')->with('question',$question);
    }

    public function changeSelection($id)
    {
        $question = Question::findOrFail($id);
        $question->is_selected = $question->is_selected == 1 ? 0 :1 ;
        $question->save();
        return redirect()->back();
    }

    public function changeStatus($id, $status)
    {
        $question = Question::findOrFail($id);
        $question->status = $status != 'active' ? 'active':'inactive';
        $question->save();
        return redirect()->back();
    }

    public function addTagCategory(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
        ]);
        $question = Question::findOrFail($request->question_id);
        $question->tag = $request->tag;
        $question->category_id = $request->attached_category;
        $question->save();
        return redirect()->back();
    }
}
