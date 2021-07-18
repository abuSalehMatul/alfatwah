<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionCreateRequest;

use DB;
use Auth;
use App\Category;
use App\Question;
use Illuminate\Support\Facades\Session;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getMostRead(){
        $locale = Session::get('APP_LOCALE');
        return Question::where('status', 'active')
        ->where('language', $locale)
        ->orderBy('view_count', 'DESC')
        ->limit(10)
        ->get();
    }

    public function search(Request $request)
    {
        $key = $request->get('key');
        $locale = Session::get('APP_LOCALE');
        return Question::where('status', 'active')
        ->where('language', $locale)
        ->where("title", 'like', "%$key%")
        ->orderBy('view_count', 'DESC')
        ->limit(10)
        ->get();
    }

    public function selectedQuestions($lang)
    {
        $fun = "answer_". $lang;
        $questions = Question::where('is_selected', 1)->paginate(15);
        return view('frontend.selectedQuestions')->with('questions', $questions);
    }

    public function getAnswerByQuestion($lang, $questionId)
    {
        $fun = "answer_". $lang;
        $questionWithAns = Question::findOrFail($questionId)->load($fun);
        if(isset($questionWithAns->$fun->status) && ($questionWithAns->$fun->status == 'active')){
            return view('frontend.questionAns')->with('questionAnswer', $questionWithAns);
        }
        return redirect()->route('ondevelop');
    }

    public function getSelectedQuestion()
    {
        $locale = Session::get('APP_LOCALE');
        return Question::where('is_selected', 1)
        ->where('status', 'active')
        ->where('language', $locale)
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    public function toAAnswer($lang, $qId)
    {
        $answer = Answer::where('question_id',$qId)
        ->where('language', $lang)
        ->first();

        return redirect()->route('to_a_answer', $answer->batch_id);
    }

    public function create()
    {
        $languages = config('app_langs');
        $categories = Category::getTopLevel()->get();
        return view('frontend.questions.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {
        /// return $request;

        try {
            $data_array = $request->only(['title','description']);
            $data_array['id'] = null;
            $question = $this->createOrUpdateQuestion($data_array);

            if($question instanceof \Exception)
                throw $question;
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        return redirect('/')->with([
            'status' => 'success',
            'message' => "Your Question have been submitted successfully."
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createOrUpdateQuestion($data_array)
    {
        try {
            DB::beginTransaction();

            if($data_array['id']){
                $data_array['updated_by'] = Auth::id();
            }else{
                $data_array['created_by'] = Auth::id();
            }
            $data_array['slug'] = \Str::slug($data_array['title'], '-');
            $data_array['language'] = app()->getLocale();
            

            $question = Question::updateOrCreate($data_array);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

        return $question;
    }
}
