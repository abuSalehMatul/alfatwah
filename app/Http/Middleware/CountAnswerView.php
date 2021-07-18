<?php

namespace App\Http\Middleware;

use App\Question;
use Closure;
use Illuminate\Http\Request;
use App\ViewAble;
use Carbon\Carbon;

class CountAnswerView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $questionId = $request->route('questionId');
        $ip = $request->ip();
        $previousTime = '';
        $previousView = ViewAble::where('model_id', $questionId)
        ->where('ip', $ip)
        ->latest()->first();
        if($previousView){
            $previousTime = $previousView->created_at;
        }

        $view = new ViewAble();
        $view->ip = $ip;
        $view->model = "App\Question";
        $view->model_id = $questionId;
        $view->save();
        if($this->getCount($previousTime, $view->created_at)){
            $question = Question::findOrFail($questionId);
            $count = $question->view_count + 1;
            $question->view_count = $count;
            $question->save();
        }
        
        return $next($request);
    }

    private function getCount($previousTime, $currentTime)
    {
        $diff_in_sec = 60;
        if($previousTime != ""){
            $currentTime = Carbon::createFromFormat('Y-m-d H:i:s', $currentTime);
            $previousTime = Carbon::createFromFormat('Y-m-d H:i:s', $previousTime);
            $diff_in_sec = $currentTime->diffInSeconds($previousTime);
        }
        if ($diff_in_sec > 59){
            return true;
        }
        return false;
    }
}
